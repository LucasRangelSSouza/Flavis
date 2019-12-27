<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PmocCommand extends ContainerAwareCommand
{
    protected $pmocModel;

    protected function configure()
    {
        $this
            ->setName('app:pmoc-lista-clientes')
            ->setDescription('Lista todos os clientes que tem contrato de PMOC em pelo menos um equipamento.')
            ->setHelp("Example: php app/console app:pmoc-lista-clientes")
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->pmocModel = $this->getContainer()->get('pmoc_model');

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln("Listando Clientes com PMOC");
        $output->writeln($this->pmocModel->getClientesComPmoc());

    }
}
