<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\OrdemCompraProduto;
use Symfony\Component\HttpFoundation\RedirectResponse;

/*
/*
 * Classe para OS
 */

class OsCRUDController extends Controller
{

    public function relatoriopmocAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $dompdf = $this->get('slik_dompdf');
        $relatorioPmocModel = $this->get('relatorio_pmoc_model');

        $html = mb_convert_encoding($relatorioPmocModel->getRelatorio($object), 'HTML-ENTITIES', 'UTF-8');

        $dompdf->getpdf($html);

        $dompdf->pdf->set_paper('A4');

        $this->renderPdf($dompdf->output());

        exit;
    }

    // Gera um relatorio de OS
    public function cancelaAction(Request $request)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $motivo = $request->get('motivo');

        if($motivo==''){
            $this->addFlash('sonata_flash_error', 'É preciso informar um motivo para cancelamento da OS');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        $object->setIsCancelada(TRUE);
        $object->setMotivoCancelamento($motivo);
        $this->admin->update($object);

        $this->addFlash('sonata_flash_success', 'Ordem de Serviço Cancelada com sucesso!');
        return new RedirectResponse($this->admin->generateUrl('list'));

    }


    // Gera um relatorio de OS
    public function relatorioAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $em = $this->container->get('doctrine')->getEntityManager();
        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $numeOs = str_pad($object->getId(), 10, '0', STR_PAD_LEFT);

        if ($object->getEndereco()) {

            $endereco = $object->getEndereco()->getLogradouro() .
                ' - ' . $object->getEndereco()->getComplemento() . ', ' .
                $object->getEndereco()->getBairro()->getNome() . ', ' .
                $object->getEndereco()->getBairro()->getCidade()->getNome() . ', ' .
                $object->getEndereco()->getBairro()->getCidade()->getUf() . ', ' .
                $object->getEndereco()->getCep();

        } else {
            $endereco = 'Não informado';
        }

        return $this->render('AppBundle:Os:relatorio_os_single.html.twig', array(
            'object' => $object,
            'base_url' => $urlBase,
            'num_os' => $numeOs,
            'data' => $object->getDataAgendada()->format('d/m/Y'),
            'cpnj_cliente' => $object->getCliente()->getCpfCnpj(),
            'endereco' => $endereco,
            'fotos' => $object->getFotos(),
        ));
    }

    public function printAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $em = $this->container->get('doctrine')->getEntityManager();
        $className = $em->getClassMetadata(get_class($object))->getName();

        switch ($className) {

            case 'AppBundle\Entity\OrdemServico' :
                $this->printOS($object);
                break;

            case 'AppBundle\Entity\AgendamentoOrdemServico' :
                $this->printOSAgendamento($object);
                break;

            case 'AppBundle\Entity\OrdemServicoLog' :
                $this->printOSHistorico($object);
                break;

            default :
                throw new NotFoundHttpException('Objeto não localizado');
                break;
        }

    }

    // Imprimi agendamento de OS em PDF
    private function printOSAgendamento($object)
    {
        $numeOs = str_pad($object->getOs()->getId(), 10, '0', STR_PAD_LEFT);
        $numeSubOs = str_pad($object->getId(), 10, '0', STR_PAD_LEFT);

        if (!$object->getOs()->getEndereco()) {
            exit('Este cliente não tem nenhum endereço de execução cadastrado');
        }

        // Pego o primeiro endereço do cliente
        $enderecos = $object->getOs()->getCliente()->getEnderecos();
        if (!count($enderecos)) {
            $this->addFlash('sonata_flash_error', 'Este cliente não tem nenhum endereço cadastrado');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        //style="border: 1px solid #111;padding: 20px;margin-top:40px;"
        $content = '<div><p style="text-align: center;padding-bottom: 30px;font-size:23px;">Retorno OS Nº ' . $numeSubOs . '
        <br/>Ordem de Serviço Principal Nº ' . $numeOs . '</p></div>';
        $content .= '<table style="width: 100% !important;">
            <tr>
                <td with="70%">DATA DA SOLICITAÇÃO: ' . $object->getCreatedAt()->format('d/m/Y') . '</td>
                <td with="30%" style="text-align: right;">
                HORA: ' . $object->getHoraAgendada()->format('H:i') . '
                ATD: ' . strtoupper($object->getOs()->getColaboradorAtendente()->getNome()) . '
                </td>
            </tr>
        </table>';


        // Primeiro Container

        $linha1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="50%" style="text-align: left;">CLIENTE: ' . strtoupper($object->getOs()->getCliente()->getNome()) . '</td>
                <td width="50%" style="text-align: right;">CPF/CNPJ: ' . $object->getOs()->getCliente()->getCpfCnpj() . '</td>
            </tr>
        </table>';

        $linha2 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="30%" style="text-align: left;" >ENDEREÇO: ' . $enderecos[0]->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $enderecos[0]->getComplemento() . '</td>
                <td width="30%" style="text-align: right;">RG/Insc: </td>
            </tr>
        </table>';

        $linha3 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $enderecos[0]->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $enderecos[0]->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $enderecos[0]->getBairro()->getCidade()->getUf() . ' CEP: ' . $enderecos[0]->getCep() . '</td>
            </tr>
        </table>';

        $linha4 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="50%" style="text-align: left;">CONTATO: ' . strtoupper($object->getSolicitante()) . '</td>
                <td width="50%" style="text-align: right;">FONE: ' . $this->getFoneContato($object->getCliente()) . '</td>
            </tr>
        </table>';

        $content1 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content1 .= $linha1 . $linha2 . $linha3 . $linha4;
        $content1 .= '</div>';


        // Segundo Container
        $linha2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">ENDEREÇO: ' . $object->getOs()->getEndereco()->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $object->getOs()->getEndereco()->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $object->getOs()->getEndereco()->getComplemento() . '</td>
            </tr>
        </table>';

        $linha2_2 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $object->getOs()->getEndereco()->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $object->getOs()->getEndereco()->getBairro()->getCidade()->getUf() . ' CEP: ' . $object->getOs()->getEndereco()->getCep() . ' </td>
            </tr>
        </table>';

        $content2 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content2 .= '<p style="text-align: center;font-weight: bold;">ENDEREÇO DE EXECUÇÃO</p>';
        $content2 .= $linha2_1 . $linha2_2;
        $content2 .= '</div>';

        $conent2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">AGENDADA PARA: ' . $object->getOs()->getDataAgendada()->format('d/m/Y') . '</td>
                <td width="30%" style="text-align: right;">HORA INÍCIO: </td>
            </tr>
        </table>';

        $content2 .= $conent2_1;


        // Terceiro Container
        $content3 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 250px;">';
        $content3 .= 'OCORRÊNCIA';
        $content3 .= '<p>' . $object->getOcorrencia() . '</p>';
        $content3 .= '</div>';


        // Quarto Container
        $content4 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 450px;">';
        $content4 .= 'SERVIÇO EXECUTADO';
        $content4 .= '<p>' . $object->getOs()->getRelatorioAvaliacao() . '</p>';
        $content4 .= '</div>';

        // Quinto Container

        $content5 = '<table style="width: 100% !important;padding-top:80px;"><tr><td width="22%">Cliente - Nome por extenso: </td><td width="53%">____________________________________________________________  </td><td width="25%"> RG:______________________</td></tr></table>';
        $content6 = '<table style="width: 100% !important;padding-top:60px;"><tr><td width="18%">Assinatura do Técnico: </td><td width="32%">________________________________</td>
        <td width="50%"> &nbsp;&nbsp;FINALIZADO DIA: _____/_____/_______ HORA: _____:_____</td></tr></table>';

        $templateHtml = '<html><head>
              <style>
                 body,html{font-face:verdana !important;font-size:20px;}
                .table { display: table; width: 100%; border-collapse: collapse !important; }
                .table-row { display: table-row !important; }
                .table-cell { display: table-cell !important; border: 1px solid black !important; padding: 1em !important; }
              </style>
            </head><body>' . $this->headerDocFlavis() . '
            <div style="position:absolute;top:100px;">
                ' . $content . $content1 . $content2 . $content3 . $content4 . $content5
            . $content6 . '
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
        $numeOs = str_pad($object->getId(), 10, '0', STR_PAD_LEFT);

        if (!$object->getEndereco()) {
            exit('Este cliente não tem nenhum endereço de execução cadastrado');
        }

        // Pego o primeiro endereço do cliente
        $enderecos = $object->getCliente()->getEnderecos();
        if (!count($enderecos)) {
            $this->addFlash('sonata_flash_error', 'Este cliente não tem nenhum endereço cadastrado');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        //style="border: 1px solid #111;padding: 20px;margin-top:40px;"
        $content = '<div><p style="font-weight:bold;text-align: center;padding-bottom: 30px;">
        <FONT SIZE="3">Ordem de Serviço Nº ' . $numeOs . '</FONT></p></div>';
        $content .= '<table style="width: 100% !important;">
            <tr>
                <td with="70%">DATA DA SOLICITAÇÃO: ' . $object->getCreatedAt()->format('d/m/Y') . '</td>
                <td with="30%" style="text-align: right;">
                HORA: ' . $object->getHoraAgendada()->format('H:i') . '
                ATD: ' . strtoupper($object->getColaboradorAtendente()->getNome()) . '
                </td>
            </tr>
        </table>';


        // Primeiro Container

        if(strlen($object->getCliente()->getCpfCnpj()) > 14) {
            $linha1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="50%" style="text-align: left;">CLIENTE: ' . strtoupper($object->getCliente()->getNome()) . '</td>
                <td width="50%" style="text-align: right;">CNPJ: ' . $object->getCliente()->getCpfCnpj() . '</td>
            </tr>
        </table>';
        }else{
            $linha1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="50%" style="text-align: left;">CLIENTE: ' . strtoupper($object->getCliente()->getNome()) . '</td>
                <td width="50%" style="text-align: right;">CPF: ' . $object->getCliente()->getCpfCnpj() . '</td>
            </tr>
        </table>';
        }

        $linha2 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="30%" style="text-align: left;" >ENDEREÇO: ' . $enderecos[0]->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $enderecos[0]->getComplemento() . '</td>
                <td width="30%" style="text-align: right;">RG/Insc: </td>
            </tr>
        </table>';

        $linha3 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $enderecos[0]->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $enderecos[0]->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $enderecos[0]->getBairro()->getCidade()->getUf() . ' CEP: ' . $enderecos[0]->getCep() . '</td>
            </tr>
        </table>';

        $linha4 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="50%" style="text-align: left;">CONTATO: ' . strtoupper($object->getSolicitante()) . '</td>
                <td width="50%" style="text-align: right;">FONE: ' . $this->getFoneContato($object->getCliente()) . '</td>
            </tr>
        </table>';

        $content1 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content1 .= $linha1 . $linha2 . $linha3 . $linha4;
        $content1 .= '</div>';


        // Segundo Container
        $linha2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">ENDEREÇO: ' . $object->getEndereco()->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $object->getEndereco()->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $object->getEndereco()->getComplemento() . '</td>
            </tr>
        </table>';

        $linha2_2 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $object->getEndereco()->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $object->getEndereco()->getBairro()->getCidade()->getUf() . ' CEP: ' . $object->getEndereco()->getCep() . ' </td>
            </tr>
        </table>';

        $content2 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content2 .= '<p style="text-align: center;font-weight: bold;">ENDEREÇO DE EXECUÇÃO</p>';
        $content2 .= $linha2_1 . $linha2_2;
        $content2 .= '</div>';

        $conent2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">AGENDADA PARA: ' . $object->getDataAgendada()->format('d/m/Y') . '</td>
                <td width="30%" style="text-align: right;">HORA INÍCIO: _______:_______</td>
            </tr>
        </table>';

        $content2 .= $conent2_1;


        // Terceiro Container
        $content3 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 250px;">';
        $content3 .= 'OCORRÊNCIA';
        $content3 .= '<p>' . $object->getOcorrencia() . '</p>';
        $content3 .= '</div>';


        // Quarto Container
        $content4 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 450px;">';
        $content4 .= 'SERVIÇO EXECUTADO';
        $content4 .= '<p>' . $object->getRelatorioAvaliacao() . '</p>';
        $content4 .= '</div>';

        // Quinto Container

        $content5 = '<table style="width: 100% !important;padding-top:80px;"><tr><td width="22%">Cliente - Nome por extenso: </td><td width="53%">____________________________________________________________  </td><td width="25%"> RG:______________________</td></tr></table>';
        $content6 = '<table style="width: 100% !important;padding-top:60px;"><tr><td width="18%">Assinatura do Técnico: </td><td width="32%">________________________________</td>
        <td width="50%"> &nbsp;&nbsp;FINALIZADO DIA: _____/_____/_______ HORA: _____:_____</td></tr></table>';

        $templateHtml = '<html><head>
              <style>
                 body,html{font-face:verdana !important;font-size:20px;}
                .table { display: table; width: 100%; border-collapse: collapse !important; }
                .table-row { display: table-row !important; }
                .table-cell { display: table-cell !important; border: 1px solid black !important; padding: 1em !important; }
              </style>
            </head><body>' . $this->headerDocFlavis() . '
            <div style="position:absolute;top:100px;">
                ' . $content . $content1 . $content2 . $content3 . $content4 . $content5 . $content6 . '
            </div>
            </body></html>
            ';

        $dompdf = $this->get('slik_dompdf');

        $html = mb_convert_encoding($templateHtml, 'HTML-ENTITIES', 'UTF-8');

        $dompdf->getpdf($html);

        $this->renderPdf($dompdf->output());
    }

    // Imprimi historico de OS em PDF
    private function printOSHistorico($object)
    {
        $numeOs = str_pad($object->getId(), 10, '0', STR_PAD_LEFT);

        if (!$object->getEndereco()) {
            exit('Este cliente não tem nenhum endereço de execução cadastrado');
        }

        // Pego o primeiro endereço do cliente
        $enderecos = $object->getCliente()->getEnderecos();
        if (!count($enderecos)) {
            $this->addFlash('sonata_flash_error', 'Este cliente não tem nenhum endereço cadastrado');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        //style="border: 1px solid #111;padding: 20px;margin-top:40px;"
        $content = '<div><p style="text-align: center;padding-bottom: 30px;">
        Ordem de Serviço Nº ' . $numeOs . '</p></div>';
        $content .= '<table style="width: 100% !important;">
            <tr>
                <td with="70%">DATA DA SOLICITAÇÃO1: ' . $object->getCreatedAt()->format('d/m/Y') . '</td>
                <td with="30%" style="text-align: right;">
                HORA: ' . $object->getHoraAgendada()->format('H:i') . '
                ATD: ' . strtoupper($object->getColaboradorAtendente()->getNome()) . '
                </td>
            </tr>
        </table>';


        // Primeiro Container

        if(strlen($object->getCliente()->getCpfCnpj()) > 14) {
            $linha1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="50%" style="text-align: left;">CLIENTE: ' . strtoupper($object->getCliente()->getNome()) . '</td>
                <td width="50%" style="text-align: right;">CNPJ: ' . $object->getCliente()->getCpfCnpj() . '</td>
            </tr>
        </table>';
        }else{
            $linha1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="50%" style="text-align: left;">CLIENTE: ' . strtoupper($object->getCliente()->getNome()) . '</td>
                <td width="50%" style="text-align: right;">CPF: ' . $object->getCliente()->getCpfCnpj() . '</td>
            </tr>
        </table>';
        }

        $linha2 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="30%" style="text-align: left;" >ENDEREÇO: ' . $enderecos[0]->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $enderecos[0]->getComplemento() . '</td>
                <td width="30%" style="text-align: right;">RG/Insc: </td>
            </tr>
        </table>';

        $linha3 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $enderecos[0]->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $enderecos[0]->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $enderecos[0]->getBairro()->getCidade()->getUf() . ' CEP: ' . $enderecos[0]->getCep() . '</td>
            </tr>
        </table>';

        $linha4 = '
        <table style="width: 100% !important;margin-top: 10px !important;">
            <tr>
                <td width="50%" style="text-align: left;">CONTATO: ' . strtoupper($object->getSolicitante()) . '</td>
                <td width="50%" style="text-align: right;">FONE: ' . $this->getFoneContato($object->getCliente()) . '</td>
            </tr>
        </table>';

        $content1 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content1 .= $linha1 . $linha2 . $linha3 . $linha4;
        $content1 .= '</div>';


        // Segundo Container
        $linha2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">ENDEREÇO: ' . $object->getEndereco()->getLogradouro() . '</td>
                <td width="30%" style="text-align: right;">CIDADE: ' . $object->getEndereco()->getBairro()->getCidade()->getNome() . '</td>
                <td width="30%" style="text-align: right;">COMPLEMENTO: ' . $object->getEndereco()->getComplemento() . '</td>
            </tr>
        </table>';

        $linha2_2 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">BAIRRO: ' . $object->getEndereco()->getBairro()->getNome() . '</td>
                <td width="30%" style="text-align: right;">UF: ' . $object->getEndereco()->getBairro()->getCidade()->getUf() . ' CEP: ' . $object->getEndereco()->getCep() . ' </td>
            </tr>
        </table>';

        $content2 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;">';
        $content2 .= '<p style="text-align: center;font-weight: bold;">ENDEREÇO DE EXECUÇÃO</p>';
        $content2 .= $linha2_1 . $linha2_2;
        $content2 .= '</div>';

        $conent2_1 = '
        <table style="width: 100% !important;">
            <tr>
                <td width="30%" style="text-align: left;">AGENDADA PARA: ' . $object->getDataAgendada()->format('d/m/Y') . '</td>
                <td width="30%" style="text-align: right;">HORA INÍCIO: _______:_______</td>
            </tr>
        </table>';

        $content2 .= $conent2_1;


        // Terceiro Container
        $content3 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 250px;">';
        $content3 .= 'OCORRÊNCIA';
        $content3 .= '<p>' . $object->getOcorrencia() . '</p>';
        $content3 .= '</div>';


        // Quarto Container
        $content4 = '<div style="border: 1px solid #111;padding: 10px;margin-top:20px;height: 450px;">';
        $content4 .= 'SERVIÇO EXECUTADO';
        $content4 .= '<p>' . $object->getRelatorioAvaliacao() . '</p>';
        $content4 .= '</div>';

        // Quinto Container

        $content5 = '<table style="width: 100% !important;padding-top:80px;"><tr><td width="22%">Cliente - Nome por extenso: </td><td width="53%">____________________________________________________________  </td><td width="25%"> RG:______________________</td></tr></table>';
        $content6 = '<table style="width: 100% !important;padding-top:60px;"><tr><td width="18%">Assinatura do Técnico: </td><td width="32%">________________________________</td>
        <td width="50%"> &nbsp;&nbsp;FINALIZADO DIA: _____/_____/_______ HORA: _____:_____</td></tr></table>';

        $templateHtml = '<html><head>
              <style>
                 body,html{font-face:verdana !important;font-size:20px;}
                .table { display: table; width: 100%; border-collapse: collapse !important; }
                .table-row { display: table-row !important; }
                .table-cell { display: table-cell !important; border: 1px solid black !important; padding: 1em !important; }
              </style>
            </head><body>' . $this->headerDocFlavis() . '
            <div style="position:absolute;top:100px;">
                ' . $content . $content1 . $content2 . $content3 . $content4 . $content5 . $content6 . '
            </div>
            </body></html>
            ';

        $dompdf = $this->get('slik_dompdf');

        $html = mb_convert_encoding($templateHtml, 'HTML-ENTITIES', 'UTF-8');

        $dompdf->getpdf($html);

        $this->renderPdf($dompdf->output());
    }

    // Imprimi historico de OS em PDF
    private function printHistoricoOS($object)
    {
        exit('ID Historico de OS: ' . $object->getId());
    }

    // Imprimi agendamento de OS em PDF
    private function printAgendamentoOS($object)
    {
        exit('ID Agendamento de OS: ' . $object->getId());
    }

    private function getFoneContato($cliente)
    {
        // Pegando contato
        $contato = 'Não cadastrado';
        $telefone = $cliente->getTelefones();
        if (count($telefone)) {
            $contato = $telefone[0]->getNumero();
        }

        return $contato;
    }

    private function renderPdf($output, $download = false)
    {
        header("Content-type:application/pdf");

        if ($download)
            header("Content-Disposition:attachment;filename='downloaded.pdf'");

        echo $output;
        exit();
    }


    private function headerDocFlavis()
    {
        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        return '

        <div style="padding-bottom:20px;position:absolute;top:0px;">
            <div style="width:300px;position:absolute;left:10px;"><img style="width:100%;" src="' . $urlBase . '/bundles/app/img/logo_email.png" alt=""></div>
            <div style="position:absolute;right:10px;font-size:17px;">

            FLAVIS CONDICIONAMENTO CONTROLE AMBIENTAL<br/>
            Rua 1046, nº 155, Lt 31<br/>
            Setor Pedro Ludovico, 75825-130<br/>
            Goiânia-GO

            </div>
        </div>

        ';
    }


    public function deshomologaAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

//        if (true === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $object->setIsHomologada(FALSE);
            $object->setStatus('PEN');
            $this->admin->update($object);
            $this->addFlash('sonata_flash_success', 'Ordem de Serviço DesHomologada com sucesso!');
            return new RedirectResponse($this->admin->generateUrl('list'));
//        } else {
//            $this->addFlash('sonata_flash_error', 'Permissão negada. Este usuário não pode deshomologar OS.');
//            return new RedirectResponse($this->admin->generateUrl('list'));
//        }

    }

    public function homologaAction()
    {
        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        if (false === $this->isGranted('ROLE_SUPER_ADMIN')) {
            // Testa se o usuário é o criador da OS
            if (false === $this->isGranted('ROLE_GERENTE_OS_HOMOLOGA')) {
                $this->addFlash('sonata_flash_error', 'Permissão negada. Este usuário não pode homologar OS.');
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        // Verifica se esta os foi encerrada.
        if (!$object->getIsEncerrada()) {
            $this->addFlash('sonata_flash_error', 'Esta OS não pode ser homologada pois não foi encerrada e não tem justificativa de encerramento!');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }


        // Homologa o objeto
        $object->setIsHomologada(TRUE);
        // Fecha a os também
        $object->setStatus('a');
        $object->setIsEncerrada(FALSE);

        $this->admin->update($object);

        ###### Envia e-mail ######
        $osModel = $this->get('os_model');

        /* TECNICO - Assunto: Encerramento da OS n 0000000
         * Olá Técnico.
         * A sua OS n 000000 foi encerrada. Para maiores informações acesse sua OS. Clique aqui.
         *
         */

        /* CLIENTE - Assunto: Encerramento da OS n 0000000
         * Olá Cliente.
         * A OS n 000000 foi encerrada. Para maiores informações acesse a OS em sua área de cliente. Clique aqui.
         *
         */


        $bodyEmail = '
                 <p>
                    Olá ' . $object->getColaboradorExecutor()->getNome() . '<br/><br/>
                    A sua OS n ' . str_pad($object->getId(), 6, '0', STR_PAD_LEFT) . ' foi encerrada. Para maiores informações acesse sua OS
                    <a href="' . $urlBase . '/app/ordemservico/' . $object->getId() . '/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="' . $urlBase . '/bundles/app/img/logo_email.png"/></p>
                 ';

        // Enviar email para interessandos na criação de uma nova OS
        $osModel->sendEmalInteressados(
            $this,
            $object,
            "Encerramento da OS n " . str_pad($object->getId(), 6, '0', STR_PAD_LEFT),
            $bodyEmail
        );
        ###### Envia e-mail ######

        $this->addFlash('sonata_flash_success', 'Ordem de Serviço Homologada');
        return new RedirectResponse($this->admin->generateUrl('list'));

    }

}