<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Colaborador;
use AppBundle\Entity\ExecucaoDeProcedimentoEquipamento;
use AppBundle\Entity\FotoExecucaoOs;
use AppBundle\Entity\FotoOs;
use AppBundle\Entity\OrdemServico;
use AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento;
use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Request\ParamFetcher;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class APISecurityController
 * @package AppBundle\Controller
 */
class APIOsController extends BaseRestAPIController
{
    /**
     * Get os to use this API.
     *
     * @ApiDoc(
     *   section = "OS",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @REST\QueryParam(name="createdAfter", requirements="[a-z]+", nullable=true, description="Date time parameter to find new os.")
     * @REST\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing pages.")
     * @REST\QueryParam(name="limit", requirements="\d+", default="5", description="How many pages to return.")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param \FOS\RestBundle\Request\ParamFetcher $paramFetcher
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array|json|xml
     */
    public function getOsAction(Request $request, ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        $repository = $this->getDoctrine()->getRepository('AppBundle:OrdemServico');

        $colaboradorLogado = $this->getUser()->getColaborador();

        if (!$colaboradorLogado instanceof Colaborador) {
            throw new HttpException(Codes::HTTP_BAD_REQUEST, "Colaborador não encontrado ou não vinculado a este usuário");
        }

        if ($request->query->has('createdAfter')) {
            $date = new \DateTime($request->get('createdAfter'));
            $results = $repository->findOsAbertasUpdatedAfter($date, $offset, $limit, $colaboradorLogado);
        }
        else {
            $results = $repository->findOsAbertas($offset, $limit, $colaboradorLogado);
        }

        return ['data' => $results];
    }

    /**
     * @ApiDoc(
     *   section = "OS",
     *   description = "Adiciona uma foto em uma os",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="file", requirements="file", nullable=false, description="Arquivo de foto.")
     * @REST\RequestParam(name="titulo", requirements="text", nullable=false, description="Título da foto")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param \AppBundle\Entity\OrdemServico $os  OS ID
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postOsFotoAction(Request $request, OrdemServico $os)
    {
        try {

            $em = $this->getDoctrine()->getManager();

            $titulo = null;
            $files = $request->files;

            if (!$request->get('titulo')) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Title this not found.");
            }else{
                $titulo = $request->get('titulo');
            }

            // FILE
            $file = $files->get('file');
            $pathFile = $this->upload($file,'path_upload_fotos_os');

            // Foto OS Entity
            $fotoOs = new FotoOs();
            $fotoOs->setTitulo($titulo);
            $fotoOs->setPathFile($pathFile);

            $em->persist($fotoOs);

            $os->addFoto($fotoOs);

            $em->persist($os);
            $em->flush();

            return [
                'data' => $fotoOs,
            ];

        } catch (InvalidFormException $exception) {

            return $exception->getForm();

        }
    }

    ###### OS #######

    /**
     * POST OS SEM PMOC
     * Parametros:
     *
     * id
     * relatorioAvaliacao
     * isEncerrada
     * justificativaEncerramento
     * receptorNome
     * receptorRg
     * imgAssinatura **** [criar propriedadae] = multipart
     *
     */


    /**
     * @ApiDoc(
     *   section = "OS",
     *   description = "Alimenta uma os realizada",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="dataAbertura", requirements="[a-z]+", nullable=true, description="Date time parameter to open os.")
     * @REST\RequestParam(name="dataEncerramento", requirements="[a-z]+", nullable=true, description="Date time parameter to close os.")
     * @REST\RequestParam(name="relatorioAvaliacao", requirements="text", nullable=false, description="Relatório")
     * @REST\RequestParam(name="isEncerrada", requirements="[0-1]", nullable=true, description="Is Encerrada")
     * @REST\RequestParam(name="justificativaEncerramento", requirements="text", nullable=true, description="Justificativa de Encerramento(Passar só quando is encerrada true)")
     * @REST\RequestParam(name="receptorNome", requirements="text", nullable=false, description="Nome do receptor")
     * @REST\RequestParam(name="receptorRg", requirements="text", nullable=false, description="Nome do receptor")
     * @REST\RequestParam(name="assinatura", requirements="file", nullable=false, description="Arquivo de imagem da assinatura.")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param \AppBundle\Entity\OrdemServico $os  OS ID
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postOsRealizadaAction(Request $request, OrdemServico $os)
    {

        try {

        $em = $this->getDoctrine()->getManager();

        $files = $request->files;

        $relatorioAvaliacao = $request->get('relatorioAvaliacao');
        $isEncerrada = $request->get('isEncerrada');
        $justificativaEncerramento = $request->get('justificativaEncerramento');
        $receptorNome = $request->get('receptorNome');
        $receptorRg = $request->get('receptorRg');
        $dataAbertura = $request->get('dataAbertura');
        $dataEncerramento = $request->get('dataEncerramento');

        $os->setRelatorioAvaliacao($relatorioAvaliacao);
        $os->setReceptorNome($receptorNome);
        $os->setReceptorRg($receptorRg);
        $os->setDataAbertura( new \DateTime($dataAbertura) );
        $os->setDataEncerramento( new \DateTime($dataEncerramento) );
        $os->setIsSync(true);

        // validar se foi encerrada, pois com isso a justificativa não pode ser null
        if($isEncerrada==1 && ($justificativaEncerramento=='' || $justificativaEncerramento==null)){
            throw new HttpException(Codes::HTTP_BAD_REQUEST, "Ao encerrar uma OS é necessário justificar o encerramento");
        }else{
            $os->setIsEncerrada($isEncerrada);
            $os->setJustificativaEncerramento($justificativaEncerramento);
        }

        $validator = $this->get('validator');
        $errors = $validator->validate($os);

        if (count($errors) > 0) {
            throw new HttpException(Codes::HTTP_BAD_REQUEST, $errors);
        }else{
            // Assinatura
            $file = $files->get('assinatura');
            $pathFileAssinatura = $this->upload($file,'path_upload_fotos_os');
        }

        $os->setReceptorAssinatura($pathFileAssinatura);

        $em->persist($os);
        $em->flush();

        return [
            'data' => $os,
        ];

        } catch (InvalidFormException $exception) {

            return $exception->getForm();

        }
    }

    /**
     * @ApiDoc(
     *   section = "OS",
     *   description = "Alimenta uma os realizada com PMOC",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="data", requirements="text", nullable=false, description="Dados da OS")
     * @REST\RequestParam(name="assinatura", requirements="file", nullable=false, description="Arquivo de imagem da assinatura.")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param \AppBundle\Entity\OrdemServico $os  OS ID
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postOsPmocRealizadaAction(Request $request, OrdemServico $os)
    {
        $jsonStringExecucoes  = $request->get('data');
//        $jsonStringExecucoes = '
//        {
//            "execucoesProcedimentos":[
//                {
//                    "id": 2,
//                    "procedimentoPmoc": {
//                        "id": 1
//                    },
//                    "relatorioAvaliacao": "Relatório quando não tem vínculo com propriedade"
//                },
//                {
//                    "id": 14,
//                    "procedimentoPmoc": {
//                        "id": 2,
//                        "propriedadeEquipamento": {
//                            "id": 1,
//                            "valores": [
//                                {
//                                    "id": 1,
//                                    "valor": "10"
//                                },
//                                {
//                                    "id": 2,
//                                    "valor": "20"
//                                },
//                                {
//                                    "id": 3,
//                                    "valor": "30"
//                                }
//                            ]
//                        }
//
//                    }
//                }
//            ],
//
//            "id":14,
//            "isEncerrada": false,
//            "receptorNome": "Bruno",
//            "receptorRg": "123",
//            "relatorioAvaliacao": ""
//        }
//        ';

        // Vefifica se os dados foram passados no json
        if(!$jsonStringExecucoes){
            throw new HttpException(Codes::HTTP_BAD_REQUEST, "Dados incompletos na requsição");
        }

        // Verifica se esta OS é PMOC
        if(!$os->getIsPmoc()){
            throw new HttpException(Codes::HTTP_BAD_REQUEST, "Esta OS não é PMOC");
        }

        $em = $this->getDoctrine()->getManager();

        $osData = json_decode($jsonStringExecucoes);
        // Verifica sem tem execucoes

        if(count($osData->execucoesProcedimentos)>0){

            foreach($osData->execucoesProcedimentos as $execucaoDeProcedimento){

                // Busco a Execução
                $execucaoDeProcedimentoEntity = $em->getRepository('AppBundle:ExecucaoDeProcedimentoEquipamento')
                    ->find($execucaoDeProcedimento->id);

                // Verifico se essa execução existe
                if (!$execucaoDeProcedimentoEntity) {
                    throw new HttpException(Codes::HTTP_BAD_REQUEST, "Entidade de Execucao de Procedimento não localizada");
                }

                // Criar novo relatório de Execução
                $relatorioExecucao = new RelatorioExecucaoDeProcedimentoEquipamento();
                $relatorioExecucao->setExecucaoDeProcedimentoEquipamento($execucaoDeProcedimentoEntity);


                // Verifica se tem relatorio escrito, pois assim não terá propriedade
                if(isset($execucaoDeProcedimento->relatorioAvaliacao)){

                    $relatorioExecucao->setRelatorioDeExecucao($execucaoDeProcedimento->relatorioAvaliacao);

                }else{ // Caso seja propriedade

                    // Transformo em json string para inserção no banco
                    $jsonValores = json_encode($execucaoDeProcedimento->procedimentoPmoc->propriedadeEquipamento);

                    $relatorioExecucao->setPropriedadeEquipamentoComValoresColetado($jsonValores);

                }

                $relatorioExecucao->setOs($os);
                $os->addRelatoriosExecucoesProcedimento($relatorioExecucao);

            }

        }else{
            //throw new HttpException(Codes::HTTP_BAD_REQUEST, "Nenhuma execução para esta OS.");
        }

        try {

            $files = $request->files;

            $isEncerrada        = $osData->isEncerrada;
            $receptorNome       = $osData->receptorNome;
            $receptorRg         = $osData->receptorRg;
            $dataAbertura       = $osData->dataAbertura;
            $dataEncerramento   = $osData->dataEncerramento;

            $os->setReceptorNome($receptorNome);
            $os->setReceptorRg($receptorRg);
            $os->setIsSync(true);
            $os->setIsEncerrada($isEncerrada);
            $os->setDataAbertura( new \DateTime($dataAbertura) );
            $os->setDataEncerramento( new \DateTime($dataEncerramento) );

            $validator = $this->get('validator');
            $errors = $validator->validate($os);

            if (count($errors) > 0) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, $errors);
            }else{
                // Assinatura
                $file = $files->get('assinatura');
                $pathFileAssinatura = $this->upload($file,'path_upload_fotos_os');
            }

            $os->setReceptorAssinatura($pathFileAssinatura);

            $em->persist($os);
            $em->flush();

            return [
                'data' => $os,
            ];

        } catch (InvalidFormException $exception) {

            return $exception->getForm();

        }

    }

    /**
     * @ApiDoc(
     *   section = "OS",
     *   description = "Adiciona uma foto em uma execucao de os",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="file", requirements="file", nullable=false, description="Arquivo de foto.")
     * @REST\RequestParam(name="titulo", requirements="text", nullable=false, description="Título da foto")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucao  ExecucaoDeProcedimentoEquipamento ID
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postFotoExecucaoOsAction(Request $request, ExecucaoDeProcedimentoEquipamento $execucao)
    {
        try {

            $em = $this->getDoctrine()->getManager();

            $titulo = null;
            $files = $request->files;

            if (!$request->get('titulo')) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Title this not found.");
            }else{
                $titulo = $request->get('titulo');
            }

            // FILE
            $file = $files->get('file');
            $pathFile = $this->upload($file,'path_upload_fotos_os');

            // Foto ExecucaoDeProcedimentoEquipamento Entity
            $fotoExecucaoOs = new FotoExecucaoOs();
            $fotoExecucaoOs->setTitulo($titulo);
            $fotoExecucaoOs->setPathFile($pathFile);

            $em->persist($fotoExecucaoOs);

            $execucao->addFoto($fotoExecucaoOs);

            $em->persist($execucao);
            $em->flush();

            return [
                'data' => $fotoExecucaoOs,
            ];

        } catch (InvalidFormException $exception) {

            return $exception->getForm();

        }
    }


    ###### FOTOS OS SEM PMOC #######

    private function upload($file,$path)
    {
        if (!$file instanceof UploadedFile) {
            throw new HttpException(Codes::HTTP_BAD_REQUEST, "File photo not found.");
        }

        $filename = uniqid() . "." . $file->getClientOriginalExtension();

        $twig    = $this->container->get('twig');
        $globals = $twig->getGlobals();
        $path = $globals[$path];
        $path_web = $globals['path_upload_fotos_os_web'];

        $file->move($path,$filename); // move the file to a path

        return $path_web . '/' . $filename;
    }
}
