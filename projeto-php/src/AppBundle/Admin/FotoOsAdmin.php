<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Documento;
use AppBundle\Form\FileWithIconType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Imagine\Imagick\Image;

class FotoOsAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $object->setNomePerfil($perfilToFilter);

    }

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function preUpdate($documento)
    {
        $this->uploadFile($documento);
    }

    public function prePersist($documento)
    {
        $this->uploadFile($documento);
    }

    private function uploadFile($documento)
    {
//        $container = $this->getConfigurationPool()->getContainer();
//        $em = $container->get('doctrine.orm.default_entity_manager');
//        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
//        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//
//        foreach($colaboradores as $colaborador) {
//            if($colaborador->getUser() == $colaboradorLogado) {
//                $perfilToFilter = $colaborador->getNomePerfil();
//            }
//        }
//
//        $this->getSubject()->getNomePerfil($perfilToFilter);

        if(!$this->hasParentFieldDescription()) {

            $fileUpload = $documento->get('pathFile')->getData();

            if(isset($fileUpload) && $fileUpload!='') {

                try {

                    $container = $this->getConfigurationPool()->getContainer();
                    $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
                    $uploadableManager->markEntityToUpload($documento->getData(), $fileUpload);

                    $em = $container->get('doctrine.orm.default_entity_manager');
                    $em->flush();

                    @unlink($documento->getData()->getOldPathFile());

                } catch (InvalidFormException $exception) {
                    return $exception->getForm();
                }

            }
        }
    }
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('titulo', null, ['label'=>'Título'])
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        $perfilToFilter = array();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado){
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
//        echo $perfilToFilter;

        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
        $query->andWhere(
            $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
        );

        $query->setParameters([
            'perfl' => $perfilToFilter
        ]);

        return $query;
    }


    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        if (TRUE === $this->isGranted('ROLE_APP_ADMIN_FOTOOS_ADMIN')) {

            $listMapper
             //   ->add('id',null,['label'=>'Código'])
                ->add('titulo', null, ['label' => 'Título'])
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                    )
                ));
        }
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // Só obriga enviar o arquivo na criação do documento
        if($this->getSubject()){
            $required =  (!$this->getSubject()->getId()) ? true : false;
        }else{
            $required = false;
        }

        $documento = $this->getSubject();
        $fileFieldOptions['data_class'] = null;

        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = "Selecione uma Foto";

        // Caso tenha arquivo vinculado
        // Adiciona um tipo view_file

        if(!$this->getSubject()){
            $file = '';
        }else{
            $file = $this->getSubject()->getPathFile();
        }

        if(!empty($file)){

            $extension = explode('.',$this->getSubject()->getPathFile());
            $iconFile = '';
            $fileFieldOptions['label'] = "Selecionar outra Foto";

            if(count($extension)>1){

                switch(strtolower($extension[1])){
                    case 'jpg';case 'jpeg';case 'png';
                    $htmlToViewFile = '<img src="/'.$this->getSubject()->getPathFile().'" class="admin-preview img-thumbnail"/>';
                    break;
                    case 'pdf';
                    $htmlToViewFile = '<a class="btn btn-primary" href="/'.$this->getSubject()->getPathFile().'" target="_blank"><i class="fa fa-file-pdf-o"></i> Clique para baixar o arquivo</a>';
                    break;
                    default:
                    $htmlToViewFile = '<a class="btn btn-primary" href="/'.$this->getSubject()->getPathFile().'" target="_blank"><i class="fa fa-file-o"></i> Clique para baixar o arquivo</a>';
                    break;
                }

                $formMapper->add('arquivoComIcone', new FileWithIconType(), [
                    'label'=>false,'mapped'=>false,'data'=>$htmlToViewFile],['type'=>"string"]);

            }
        }

        $formMapper
            ->add('pathFile', 'file', $fileFieldOptions)
            ->add('titulo', null, ['label'=>'Título'])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titulo', null, ['label'=>'Título'])
        ;
    }
}
