<?php

namespace AppBundle\Command;

use AppBundle\Entity\Cidade;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CorrecoesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:correcoes-flavis')
            ->setDescription('Executa algumas correções de dados no sistema.')
            ->setHelp("Example: php app/console app:correcoes-flavis")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln("Iniciando importação de equipamentos...");

        $filepath = __DIR__ . "/../DataFixtures/equipamentos/ACJ.csv";
        $file_handle = fopen($filepath, "r");
        $lineNumber = 1;

        while (!feof($file_handle)) {
            $line = trim(fgets($file_handle));
            try {

                $columns = explode(';', $line);
//                    if (count($columns) != 4) {
//                        throw new \InvalidArgumentException("Linha " . $lineNumber . " contém conteúdo inválido: " . $line);
//                    }

                array_walk($columns, 'trim');

                $tituloEquipamento = $columns[0];
                $procedimentoTitulo = $columns[1];
                $periodicidade = $columns[2];

                $output->writeln("Equipamento: " . $tituloEquipamento);

            } catch (\InvalidArgumentException $iae) {
                throw $iae;
            }
        }

    }
}
