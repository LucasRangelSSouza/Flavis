<?php

namespace Knp\Menu\Integration\Symfony;

use Knp\Menu\Factory\ExtensionInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Factory able to use the Symfony2 Routing component to build the url
 */
class RoutingExtension extends ContainerAware implements ExtensionInterface
{

    /**
     * @return \Sonata\AdminBundle\Admin\Pool
     */
    protected function getAdminPool()
    {
        return $this->container->get('sonata.admin.pool');
    }

    public function perfilLogado()
    {
        $container = $this->getAdminPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        return $perfilToFilter;
    }
    private $generator;

    public function __construct(UrlGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function buildOptions(array $options = array())
    {
        if (!empty($options['route'])) {
//            $perfilLogado = $this->perfilLogado();//Call to a member function get() on null
            $params = isset($options['routeParameters']) ? $options['routeParameters'] : array();
            $absolute = isset($options['routeAbsolute']) ? $options['routeAbsolute'] : false;
            $options['uri'] = $this->generator->generate($options['route'], $params, $absolute, $perfilLogado = 'lista');

            // adding the item route to the extras under the 'routes' key (for the Silex RouteVoter)
            $options['extras']['routes'][] = array(
                'route' => $options['route'],
                'parameters' => $params,
            );
        }

        return $options;
    }

    public function buildItem(ItemInterface $item, array $options)
    {
    }
}
