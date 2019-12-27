<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Documento;
use AppBundle\Form\FileWithIconType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocumentoAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(ErrorElement $errorElement, $object)
    {

        if ($object->getPathFile() == '') {
            $errorElement->addViolation('Atenção, selecione um arquivo')->end();
        }

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
        if ($documento->get('pathFile')->getData()) {
            $fileUpload = $documento->get('pathFile')->getData();

            if (isset($fileUpload) && $fileUpload != '') {

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
            ->add('titulo', null, ['label' => 'Título'])
            ->add('dataEmissao', null, ['label' => 'Emissão'])
            ->add('dataValidade', null, ['label' => 'Validade'])
            ->add('observacoes', null, ['label' => 'Obs']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('titulo', null, ['label' => 'Título'])
            ->add('dataEmissao', null, ['label' => 'Emissão'])
            ->add('dataValidade', null, ['label' => 'Validade'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'format' => 'dd/MM/yyyy',
        );

        // Só obriga enviar o arquivo na criação do documento
        if ($this->getSubject()) {
            $required = (!$this->getSubject()->getId()) ? true : false;
        } else {
            $required = false;
        }

        $documento = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = "Selecione um arquivo";

        $formMapper
            ->add('tipoDocumento', 'entity', [
                    'label' => 'Tipo de Documento',
                    'class' => 'AppBundle:TipoDocumento',
                    'empty_data' => '0',
                    'placeholder' => 'Selecione um tipo de documento',
                    'required' => true,
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                        $container = $this->getConfigurationPool()->getContainer();
                        $em = $container->get('doctrine.orm.default_entity_manager');

                        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));

                        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                        foreach ($colaboradores as $colaborador) {
                            if ($colaborador->getUser() == $colaboradorLogado) {
                                $perfilToFilter = $colaborador->getNomePerfil();
                            }
                        }

                        $queryBuilder = $defaultRepository->createQueryBuilder('c');
                        $queryBuilder
                            ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                            ->setParameters([
                                'perfl' => $perfilToFilter
                            ]);

                        return $queryBuilder;
                    },
                ]
            );
        //->add('tipoDocumento', 'sonata_type_model', ['label'=>'Tipo','placeholder' => 'Selecione']);

        // Caso tenha arquivo vinculado
        // Adiciona um tipo view_file
        if ($this->getSubject()) {
            $file = $this->getSubject()->getPathFile();
        } else {
            $file = '';
        }

        if (!empty($file)) {

            $extension = explode('.', $this->getSubject()->getPathFile());
            $iconFile = '';
            $fileFieldOptions['label'] = "Selecionar outro arquivo";

            if (count($extension) > 1) {

                switch (strtolower($extension[1])) {
                    case 'jpg';
                        $htmlToViewFile = '<img src="/' . $this->getSubject()->getPathFile() . '" class="admin-preview img-thumbnail"/>';
                        break;
                    case 'jpeg';
                        $htmlToViewFile = '<img src="/' . $this->getSubject()->getPathFile() . '" class="admin-preview img-thumbnail"/>';
                        break;
                    case 'png';
                        $htmlToViewFile = '<img src="/' . $this->getSubject()->getPathFile() . '" class="admin-preview img-thumbnail"/>';
                        break;
                    case 'pdf';
                        $htmlToViewFile = '<a class="btn btn-primary" href="/' . $this->getSubject()->getPathFile() . '" target="_blank"><i class="fa fa-file-pdf-o"></i> Clique para baixar o arquivo</a>';
                        break;
                    default:
                        $htmlToViewFile = '<a class="btn btn-primary" href="/' . $this->getSubject()->getPathFile() . '" target="_blank"><i class="fa fa-file-o"></i> Clique para baixar o arquivo</a>';
                        break;
                }

                $formMapper->add('arquivoComIcone', new FileWithIconType(), [
                    'label' => false, 'mapped' => false, 'data' => $htmlToViewFile], ['type' => "string"]);

            }
        }

        $formMapper
            ->add('pathFile', 'file', array(
                'required' => true,
                'label' => 'Selecione um arquivo(JPG, JPEG, PNG, PDF, DOCX)',
                'data_class' => null,
                'attr' => array('class'=>'file')
            ))
            ->add('titulo', null, ['label' => 'Título'])
            ->add('dataEmissao', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Emissão', 'required' => false,'attr' => ['class' => 'mascara_data']])
            ->add('dataValidade', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Validade', 'required' => false,'attr' => ['class' => 'mascara_data']])
            ->add('observacoes', null, ['label' => 'Obs']);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titulo', null, ['label' => 'Título'])
            ->add('dataEmissao', null, ['label' => 'Emissão'])
            ->add('dataValidade', null, ['label' => 'Validade'])
            ->add('observacoes', null, ['label' => 'Obs']);
    }
}
