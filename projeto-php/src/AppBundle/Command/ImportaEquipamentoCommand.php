<?php

namespace AppBundle\Command;

use AppBundle\Entity\AgendamentoManutencaoEquipamento;
use AppBundle\Entity\Cidade;
use AppBundle\Entity\EquipamentoCliente;
use AppBundle\Entity\MarcaEquipamento;
use AppBundle\Entity\ModeloEquipamento;
use AppBundle\Entity\TituloAgendamentoManutencaoEquipamento;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportaEquipamentoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:importa-equipamentos')
            ->setDescription('Executa algumas correções de dados no sistema.')
            ->setHelp("Example: php app/console app:importa-equipamentos")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln("Iniciando importação de equipamentos...");

        $marcaEntity = $em->getRepository('AppBundle:MarcaEquipamento');
        $modeloEntity = $em->getRepository('AppBundle:ModeloEquipamento');

        $rtituloAgendamentoManutencaoEquipamento = $em->getRepository('AppBundle:TituloAgendamentoManutencaoEquipamento');

        $arquivos = ['ACJ','BOMBA-DE-CIRCULACAO','CHILLER','COIFA-LAVADORA','EXAUSTOR','FAN-COIL','FANCOLETE','K7','MINI-SPLIT','MOTO-BOMBA','SPLITAO','TORRE','VENTILADOR'];

        foreach($arquivos as $aquivo){


############ Criar o equipamento com marca e modelo ############

            // É preciso verificar se este equipamento já não existe


            $sql = "SELECT e FROM AppBundle:EquipamentoCliente e
                JOIN e.marca m
                WHERE m.titulo = :tituloMarcaEquipamento
                ";

            $query = $em->createQuery($sql);
            $query->setParameter('tituloMarcaEquipamento',$aquivo);

            $equipamento = $query->getResult();

            if(count($equipamento)){

                $equipamento = $equipamento[0];

            }else{
                // Cria o equipamento
                $equipamento = new EquipamentoCliente();

                // Procuro um equipamento com o nome passado
                $marca = $marcaEntity->findOneBy(array('titulo' => $aquivo));

                if ($marca) {

                    $modelo = $modeloEntity->findOneBy(array('titulo' => $aquivo));

                }else{

                    $modelo = new ModeloEquipamento();
                    $modelo->setTitulo($aquivo);
                    $em->persist($modelo);

                    $marca = new MarcaEquipamento();
                    $marca->setTitulo($aquivo);
                    $em->persist($marca);
                }

                $equipamento->setMarca($marca);
                $equipamento->setModelo($modelo);

                $em->persist($equipamento);
            }


############ Criar todos os procedimentos para este equipamento corrente ############

            $filepath = __DIR__ . "/../DataFixtures/equipamentos/$aquivo.csv";
            $file_handle = fopen($filepath, "r");

            while (!feof($file_handle)) {
                $line = trim(fgets($file_handle));
                try {

                    $columns = explode(';', $line);

                    $tituloProcedimento = trim(str_ireplace('"','',$columns[1]));
                    $periodicidade = trim(str_ireplace('"','',$columns[2]));

                    $output->writeln("Equipamento: " . $aquivo);

                    // Criar novo procedimento
                    $procedimento = new AgendamentoManutencaoEquipamento();

                    // Buscar ou criar um novo título de procedimento
                    $tituloAgendamentoManutencaoEquipamento = $rtituloAgendamentoManutencaoEquipamento->findOneBy(array('titulo' => $tituloProcedimento));

                    if(!$tituloAgendamentoManutencaoEquipamento){

                        $tituloAgendamentoManutencaoEquipamento = new TituloAgendamentoManutencaoEquipamento();
                        $tituloAgendamentoManutencaoEquipamento->setTitulo($tituloProcedimento);

                        $em->persist($tituloAgendamentoManutencaoEquipamento);
                    }

                    $procedimento->setTitulo($tituloAgendamentoManutencaoEquipamento);

                    // Adicionando periodicidade no procedimento

                    switch($periodicidade){

                        case 'SEMANAL': $procedimento->setPeriodicidade(7);
                            break;

                        case 'MENSAL': $procedimento->setPeriodicidade(30);
                            break;

                        case 'BIMESTRAL': $procedimento->setPeriodicidade(60);
                            break;

                        case 'TRIMESTRAL': $procedimento->setPeriodicidade(90);
                            break;

                        case 'SEMESTRAL': $procedimento->setPeriodicidade(180);
                            break;

                        case 'ANUAL': $procedimento->setPeriodicidade(365);
                            break;
                    }

                    $em->persist($procedimento);

                    // Adicionar procedimento no equipamento
                    $equipamento->addProcedimentosPreventivo($procedimento);
                    $equipamento->setEspecificacoes('...');
                    $em->persist($equipamento);

                    $em->flush();

                } catch (\InvalidArgumentException $iae) {
                        throw $iae;
                }
            }

        } // end loop arquivos

    }

}
