<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Cidade;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Doctrine\Common\DataFixtures\AbstractFixture;
use \Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LoadCidadeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $parsed = Yaml::parse(dirname(__DIR__).'/fixtures-cidades.yml');

        $cidades = reset($parsed);

        foreach($cidades as $cidade){
            $c = new Cidade();

            $c->setNome($cidade['nome']);
            $c->setUf($cidade['uf']);
            $manager->persist($c);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}