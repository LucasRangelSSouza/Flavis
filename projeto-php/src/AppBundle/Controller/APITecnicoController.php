<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Colaborador;
use AppBundle\Entity\ExecucaoDeProcedimentoEquipamento;
use AppBundle\Entity\FotoExecucaoOs;
use AppBundle\Entity\FotoOs;
use AppBundle\Entity\OrdemServico;
use AppBundle\Entity\PosicaoTecnico;
use AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento;
use AppBundle\Entity\TempoOciosoTecnico;
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
class APITecnicoController extends BaseRestAPIController
{

    /**
     * @ApiDoc(
     *   section = "Técnico",
     *   description = "Cadastra um array de tempo ocioso de um técnico",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="data", requirements="text", nullable=false, description="Todas as ocorrências de tempos ociosos")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postArrayTempoOciosoTecnicoAction(Request $request)
    {

        try {

            $colaboradorLogado = $this->getUser()->getColaborador();

            if (!$colaboradorLogado instanceof Colaborador) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Colaborador não encontrado ou não vinculado a este usuário");
            }

            $em = $this->getDoctrine()->getManager();

            // [
            //  {"observacao":"asdasdadasda","tempoGasto":30, "dataHoraAtividade":yyyy-MM-dd'T'HH:mm:ss},
            //  {"observacao":"asdasdadasda","tempoGasto":30, "dataHoraAtividade":yyyy-MM-dd'T'HH:mm:ss},
            //  {"observacao":"asdasdadasda","tempoGasto":30, "dataHoraAtividade":yyyy-MM-dd'T'HH:mm:ss},
            // }

            $jsonStringTempoOciosoTecnico  = $request->get('data');

            // Vefifica se os dados foram passados no json
            if(!$jsonStringTempoOciosoTecnico){
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Dados incompletos na requsição");
            }

            $ociosidadesData = json_decode($jsonStringTempoOciosoTecnico);

            // Verifica sem tem localizações
            if(count($ociosidadesData)>0){

                foreach($ociosidadesData as $atividade) {

                    // Parameters
                    $dataHoraAtividade = (!isset($atividade->dataHoraAtividade)) ? new \DateTime() : new \DateTime($atividade->dataHoraAtividade);

                    $tempoOcioso = new TempoOciosoTecnico();
                    $tempoOcioso->setTecnico($colaboradorLogado);
                    $tempoOcioso->setObservacao($atividade->observacao);
                    $tempoOcioso->setTempoGasto($atividade->tempoGasto);
                    $tempoOcioso->setDataHoraAtividade($dataHoraAtividade);

                    $em->persist($tempoOcioso);

                }

                $em->flush();

                return array(
                    'data' => $tempoOcioso,
                );

            }

            return array(
                'data' => array(),
            );


        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }

    }

    /**
     * @ApiDoc(
     *   section = "Técnico",
     *   description = "Cadastra um tempo ocioso de um técnico",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="observacao", requirements="text", nullable=false, description="A ocorrência do tempo ocioso")
     * @REST\RequestParam(name="tempoGasto", requirements="\d+", nullable=false, description="Tempo gasto em minutos")
     * @REST\RequestParam(name="dataHoraAtividade", requirements="[a-z]+", nullable=false, description="Data hora do cadastro da atividade")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postTempoOciosoTecnicoAction(Request $request)
    {
        try {

            $colaboradorLogado = $this->getUser()->getColaborador();

            if (!$colaboradorLogado instanceof Colaborador) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Colaborador não encontrado ou não vinculado a este usuário");
            }

            $em = $this->getDoctrine()->getManager();

            $dataHora =  new \DateTime($request->get('dataHoraAtividade'));

            $tempoOcioso = new TempoOciosoTecnico();
            $tempoOcioso->setTecnico($colaboradorLogado);
            $tempoOcioso->setObservacao($request->get('observacao'));
            $tempoOcioso->setTempoGasto($request->get('tempoGasto'));
            $tempoOcioso->setDataHoraAtividade($dataHora);

            $em->persist($tempoOcioso);
            $em->flush();

            return array(
                'data' => $tempoOcioso
            );

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }


    /**
     * @ApiDoc(
     *   section = "Técnico",
     *   description = "Adiciona uma localização de um técnico",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @REST\RequestParam(name="data", requirements="text", nullable=false, description="Localizaçoes do técnico")
     *
     * @REST\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     *
     */
    public function postLocationTecnicoAction(Request $request)
    {

//        * @REST\RequestParam(name="dataHora", requirements="text", nullable=true, description="Data Hora")
//    * @REST\RequestParam(name="latitude", requirements="text", nullable=false, description="Latitude")
//    * @REST\RequestParam(name="longitude", requirements="text", nullable=false, description="Longitude")
//    * @REST\RequestParam(name="batteryLevel", requirements="text", nullable=false, description="Nível da Bateria")
//
        try {

            $colaboradorLogado = $this->getUser()->getColaborador();

            if (!$colaboradorLogado instanceof Colaborador) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Colaborador não encontrado ou não vinculado a este usuário");
            }

            $em = $this->getDoctrine()->getManager();

//            {"localizacoesTecnico":[
//             {"latitude":15.1515151,"longitude":-48.45454545, "dataHora":yyyy-MM-dd'T'HH:mm:ss,"batteryLevel":100},
//             {"latitude":15.1515151,"longitude":-48.45454545, "dataHora":yyyy-MM-dd'T'HH:mm:ss,"batteryLevel":100},
//             {"latitude":15.1515151,"longitude":-48.45454545, "dataHora":yyyy-MM-dd'T'HH:mm:ss,"batteryLevel":100}
//            ]}

            $jsonStringLocalizacoesTecnico  = $request->get('data');

            // Vefifica se os dados foram passados no json
            if(!$jsonStringLocalizacoesTecnico){
                throw new HttpException(Codes::HTTP_BAD_REQUEST, "Dados incompletos na requsição");
            }

            $locaisData = json_decode($jsonStringLocalizacoesTecnico);


            // Verifica sem tem localizações
            if(count($locaisData)>0){

                foreach($locaisData as $localTecnico) {

                    // Parameters
                    $dataHora = (!isset($localTecnico->dataHora)) ? new \DateTime() : new \DateTime($localTecnico->dataHora);
                    $latitude = $localTecnico->latitude;
                    $longitude = $localTecnico->longitude;
                    $batteryLevel = $localTecnico->batteryLevel;

                    $localTecnico = new PosicaoTecnico();
                    $localTecnico->setCreatedAt($dataHora);
                    $localTecnico->setLatitude($latitude);
                    $localTecnico->setLongitude($longitude);
                    $localTecnico->setBatteryLevel($batteryLevel);
                    $localTecnico->setTecnico($colaboradorLogado);

                    $em->persist($localTecnico);

                }

                $em->flush();

                return array(
                    'data' => $localTecnico,
                );

            }

            return array(
                'data' => array(),
            );


        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

}
