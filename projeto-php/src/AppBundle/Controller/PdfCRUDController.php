<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\OrdemCompraProduto;

/*
 * Classe para gerar pdf baseado nas listas
 */
class PdfCRUDController extends Controller
{
    public function printAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $em = $this->container->get('doctrine')->getEntityManager();
        $className = $em->getClassMetadata(get_class($object))->getName();

        switch($className){

            case 'AppBundle\Entity\OrcamentoProduto' :
                $this->printOrcamento($object);
                break;

            case 'AppBundle\Entity\OrdemServico' :
                $this->printOS($object);
                break;

            case 'AppBundle\Entity\AgendamentoOrdemServico' :
                $this->printAgendamentoOS($object);
                break;

            default :
                throw new NotFoundHttpException('Objeto não localizado');
                break;
        }

    }

    // Imprimi orçamento em PDF
    private function printOrcamento($object)
    {

        $content = '';
        for($i=0;$i<100;$i++){
            $content .= '<div class="teste" style="page-break-after: always;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>';
        }

        $templateHtml = '<html><head></head><body>' . $this->headerDocFlavis() . '
        <div style="position:absolute;top:100px;">

            <div style="border: 1px solid #111;padding: 20px;margin-top:40px;">
                '.$content.'
            </div>

        </div>
        </body></html>
        ';

        $dompdf = $this->get('slik_dompdf');

        $html = mb_convert_encoding($templateHtml, 'HTML-ENTITIES', 'UTF-8');

        $dompdf->getpdf($html);

        $this->renderPdf($dompdf->output());

    }

    // Imprimi abertura de OS em PDF
    private function printOS($object)
    {
        exit('ID OS: ' . $object->getId());
    }

    // Imprimi agendamento de OS em PDF
    private function printAgendamentoOS($object)
    {
        exit('ID Agendamento de OS: ' . $object->getId());
    }

    private function renderPdf($output,$download=false)
    {
        header("Content-type:application/pdf");

        if($download)
            header("Content-Disposition:attachment;filename='downloaded.pdf'");

        echo $output;
        exit();
    }


    private function headerDocFlavis()
    {
        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        return '

        <div style="padding-bottom:20px;position:absolute;top:0px;">
            <div style="width:300px;position:absolute;left:10px;"><img style="width:100%;" src="'.$urlBase.'/bundles/app/img/logo_app.png" alt=""></div>
            <div style="position:absolute;right:10px;font-size:17px;">

            FLAVIS CONDICIONAMENTO CONTROLE AMBIENTAL<br/>
            Rua 1046, nº 155, Lt 31<br/>
            Setor Pedro Ludovico, 75825-130<br/>
            Goiânia-GO

            </div>
        </div>

        ';
    }

}