<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher //extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{

    //Para não precisar mais extender a classe Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Redirects the user to another URL.
     *
     * @param string $path   The path info to redirect to.
     * @param string $route  The route that matched
     * @param string $scheme The URL scheme (null to keep the current one)
     *
     * @return array An array of parameters
     */
    public function redirect($path, $route, $scheme = null)
    {
        return array(
            '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction',
            'path' => $path,
            'permanent' => true,
            'scheme' => $scheme,
            'httpPort' => $this->context->getHttpPort(),
            'httpsPort' => $this->context->getHttpsPort(),
            '_route' => $route,
        );
    }

    /**
     * Get merged default parameters.
     *
     * @param array $params   The parameters
     * @param array $defaults The defaults
     *
     * @return array Merged default parameters
     */
    protected function mergeDefaults($params, $defaults)
    {
        foreach ($params as $key => $value) {
            if (!is_int($key)) {
                $defaults[$key] = $value;
            }
        }

        return $defaults;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
//        $context = $this->context;
//        $request = $this->request;

//        echo $pathinfo.'                             ';

        $array = explode('/', $pathinfo);
        if($array[1] == 'app') {
            $perfilLogado = $array[2];
        }else{
            $perfilLogado = $array[1];
        }

//        echo 'Perfil logado: '.$perfilLogado.'                             ';
//        if (($pathinfo === '/login') || ($pathinfo === '/login_check') || ($pathinfo === '/logout') || ($pathinfo === '/')) {

//            echo 'Rastreabilidade! Validação da URL no Método match em appProdUrlMatcher - perfil logado: sem perfil                             ';
//
//        }else{
//
//            echo 'Rastreabilidade! Validação da URL no Método match em appProdUrlMatcher - perfil logado: '.$perfilLogado.'                             ';
//
//        }

        // sonata_admin_redirect
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
        }

        // sonata_admin_dashboard
        if ($pathinfo === '/'.$perfilLogado.'/dashboard') {
            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
        }

if (0 === strpos($pathinfo, '/core')) {
    // sonata_admin_retrieve_form_element
    if ($pathinfo === '/core/get-form-field-element') {
        return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
    }

    // sonata_admin_append_form_element
    if ($pathinfo === '/core/append-form-field-element') {
        return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
    }

    // sonata_admin_short_object_information
    if (0 === strpos($pathinfo, '/core/get-short-object-description') && preg_match('#^/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
    }

    // sonata_admin_set_object_field_value
    if ($pathinfo === '/core/set-object-field-value') {
        return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
    }

}

// sonata_admin_search
if ($pathinfo === '/search') {
    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
}

// sonata_admin_retrieve_autocomplete_items
if ($pathinfo === '/core/get-autocomplete-items') {
    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
}

        if (0 === strpos($pathinfo, '/app')) {


            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/documento')) {
                // admin_app_documento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/documento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_list',  '_route' => 'admin_app_documento_list',);
                }

                // admin_app_documento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/documento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_create',  '_route' => 'admin_app_documento_create',);
                }

                // admin_app_documento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/documento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_batch',  '_route' => 'admin_app_documento_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_documento_edit
                if (preg_match('#^/app/documento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_documento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_edit',));
                }

                // admin_app_documento_delete
                if (preg_match('#^/app/documento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_documento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_delete',));
                }

                // admin_app_documento_show
                if (preg_match('#^/app/documento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_documento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_show',));
                }

                // admin_app_documento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/documento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_export',  '_route' => 'admin_app_documento_export',);
                }

                // admin_app_documento_acl
                if (preg_match('#^/app/documento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_documento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.documento',  '_sonata_name' => 'admin_app_documento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/produtosaida')) {
                // admin_app_produtosaida_list
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosaida/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_list',  '_route' => 'admin_app_produtosaida_list',);
                }

                // admin_app_produtosaida_create
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosaida/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_create',  '_route' => 'admin_app_produtosaida_create',);
                }

                // admin_app_produtosaida_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosaida/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_batch',  '_route' => 'admin_app_produtosaida_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_produtosaida_edit
                if (preg_match('#^/app/produtosaida/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosaida_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_edit',));
                }

                // admin_app_produtosaida_delete
                if (preg_match('#^/app/produtosaida/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosaida_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_delete',));
                }

                // admin_app_produtosaida_show
                if (preg_match('#^/app/produtosaida/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosaida_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_show',));
                }

                // admin_app_produtosaida_export
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosaida/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_export',  '_route' => 'admin_app_produtosaida_export',);
                }

                // admin_app_produtosaida_acl
                if (preg_match('#^/app/produtosaida/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosaida_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.produto_saida',  '_sonata_name' => 'admin_app_produtosaida_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/'.$perfilLogado.'/endereco')) {
                // admin_app_endereco_list
                if ($pathinfo === '/app/'.$perfilLogado.'/endereco/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_list',  '_route' => 'admin_app_endereco_list',);
                }

                // admin_app_endereco_create
                if ($pathinfo === '/app/'.$perfilLogado.'/endereco/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_create',  '_route' => 'admin_app_endereco_create',);
                }

                // admin_app_endereco_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/endereco/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_batch',  '_route' => 'admin_app_endereco_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_endereco_edit
                if (preg_match('#^/app/endereco/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_endereco_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_edit',));
                }

                // admin_app_endereco_delete
                if (preg_match('#^/app/endereco/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_endereco_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_delete',));
                }

                // admin_app_endereco_show
                if (preg_match('#^/app/endereco/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_endereco_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_show',));
                }

                // admin_app_endereco_export
                if ($pathinfo === '/app/'.$perfilLogado.'/endereco/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_export',  '_route' => 'admin_app_endereco_export',);
                }

                // admin_app_endereco_acl
                if (preg_match('#^/app/endereco/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_endereco_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.endereco',  '_sonata_name' => 'admin_app_endereco_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/'.$perfilLogado.'/telefone')) {
                // admin_app_telefone_list
                if ($pathinfo === '/app/'.$perfilLogado.'/telefone/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_list',  '_route' => 'admin_app_telefone_list',);
                }

                // admin_app_telefone_create
                if ($pathinfo === '/app/'.$perfilLogado.'/telefone/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_create',  '_route' => 'admin_app_telefone_create',);
                }

                // admin_app_telefone_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/telefone/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_batch',  '_route' => 'admin_app_telefone_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_telefone_edit
                if (preg_match('#^/app/telefone/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_telefone_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_edit',));
                }

                // admin_app_telefone_delete
                if (preg_match('#^/app/telefone/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_telefone_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_delete',));
                }

                // admin_app_telefone_show
                if (preg_match('#^/app/telefone/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_telefone_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_show',));
                }

                // admin_app_telefone_export
                if ($pathinfo === '/app/'.$perfilLogado.'/telefone/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_export',  '_route' => 'admin_app_telefone_export',);
                }

                // admin_app_telefone_acl
                if (preg_match('#^/app/telefone/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_telefone_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.telefone',  '_sonata_name' => 'admin_app_telefone_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/funcao')) {
                // admin_app_funcao_list
                if ($pathinfo === '/app/'.$perfilLogado.'/funcao/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_list',  '_route' => 'admin_app_funcao_list',);
                }

                // admin_app_funcao_create
                if ($pathinfo === '/app/'.$perfilLogado.'/funcao/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_create',  '_route' => 'admin_app_funcao_create',);
                }

                // admin_app_funcao_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/funcao/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_batch',  '_route' => 'admin_app_funcao_batch',);
                }

                // admin_app_funcao_export
                if ($pathinfo === '/app/'.$perfilLogado.'/funcao/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_export',  '_route' => 'admin_app_funcao_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_funcao_edit
                if (preg_match('#^/app/funcao/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_funcao_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_edit',));
                }

                // admin_app_funcao_delete
                if (preg_match('#^/app/funcao/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_funcao_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_delete',));
                }

                // admin_app_funcao_show
                if (preg_match('#^/app/funcao/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_funcao_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_show',));
                }

                // admin_app_funcao_acl
                if (preg_match('#^/app/funcao/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_funcao_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.funcao',  '_sonata_name' => 'admin_app_funcao_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tiponegocio')) {
                // admin_app_tiponegocio_list
                if ($pathinfo === '/app/'.$perfilLogado.'/tiponegocio/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_list',  '_route' => 'admin_app_tiponegocio_list',);
                }

                // admin_app_tiponegocio_create
                if ($pathinfo === '/app/'.$perfilLogado.'/tiponegocio/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_create',  '_route' => 'admin_app_tiponegocio_create',);
                }

                // admin_app_tiponegocio_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/tiponegocio/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_batch',  '_route' => 'admin_app_tiponegocio_batch',);
                }

                // admin_app_tiponegocio_export
                if ($pathinfo === '/app/'.$perfilLogado.'/tiponegocio/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_export',  '_route' => 'admin_app_tiponegocio_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_tiponegocio_edit
                if (preg_match('#^/app/tiponegocio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tiponegocio_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_edit',));
                }

                // admin_app_tiponegocio_delete
                if (preg_match('#^/app/tiponegocio/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tiponegocio_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_delete',));
                }

                // admin_app_tiponegocio_show
                if (preg_match('#^/app/tiponegocio/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tiponegocio_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_show',));
                }

                // admin_app_tiponegocio_acl
                if (preg_match('#^/app/tiponegocio/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tiponegocio_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.tipo_negocio',  '_sonata_name' => 'admin_app_tiponegocio_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/cidade')) {
                // admin_app_cidade_list
                if ($pathinfo === '/app/'.$perfilLogado.'/cidade/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_list',  '_route' => 'admin_app_cidade_list',);
                }

                // admin_app_cidade_create
                if ($pathinfo === '/app/'.$perfilLogado.'/cidade/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_create',  '_route' => 'admin_app_cidade_create',);
                }

                // admin_app_cidade_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/cidade/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_batch',  '_route' => 'admin_app_cidade_batch',);
                }

                // admin_app_cidade_export
                if ($pathinfo === '/app/'.$perfilLogado.'/cidade/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_export',  '_route' => 'admin_app_cidade_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_cidade_edit
                if (preg_match('#^/app/cidade/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cidade_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_edit',));
                }

                // admin_app_cidade_delete
                if (preg_match('#^/app/cidade/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cidade_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_delete',));
                }

                // admin_app_cidade_show
                if (preg_match('#^/app/cidade/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cidade_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_show',));
                }

                // admin_app_cidade_acl
                if (preg_match('#^/app/cidade/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cidade_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.cidade',  '_sonata_name' => 'admin_app_cidade_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/bairro')) {
                // admin_app_bairro_list
                if ($pathinfo === '/app/'.$perfilLogado.'/bairro/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_list',  '_route' => 'admin_app_bairro_list',);
                }

                // admin_app_bairro_create
                if ($pathinfo === '/app/'.$perfilLogado.'/bairro/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_create',  '_route' => 'admin_app_bairro_create',);
                }

                // admin_app_bairro_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/bairro/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_batch',  '_route' => 'admin_app_bairro_batch',);
                }

                // admin_app_bairro_export
                if ($pathinfo === '/app/'.$perfilLogado.'/bairro/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_export',  '_route' => 'admin_app_bairro_export',);
                }


                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_bairro_edit
                if (preg_match('#^/app/bairro/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bairro_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_edit',));
                }

                // admin_app_bairro_delete
                if (preg_match('#^/app/bairro/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bairro_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_delete',));
                }

                // admin_app_bairro_show
                if (preg_match('#^/app/bairro/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bairro_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_show',));
                }

                // admin_app_bairro_acl
                if (preg_match('#^/app/bairro/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bairro_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.bairro',  '_sonata_name' => 'admin_app_bairro_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tipo')) {
                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tipoendereco')) {
                    // admin_app_tipoendereco_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipoendereco/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_list',  '_route' => 'admin_app_tipoendereco_list',);
                    }

                    // admin_app_tipoendereco_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipoendereco/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_create',  '_route' => 'admin_app_tipoendereco_create',);
                    }

                    // admin_app_tipoendereco_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipoendereco/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_batch',  '_route' => 'admin_app_tipoendereco_batch',);
                    }

                    // admin_app_tipoendereco_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipoendereco/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_export',  '_route' => 'admin_app_tipoendereco_export',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_tipoendereco_edit
                    if (preg_match('#^/app/tipoendereco/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipoendereco_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_edit',));
                    }

                    // admin_app_tipoendereco_delete
                    if (preg_match('#^/app/tipoendereco/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipoendereco_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_delete',));
                    }

                    // admin_app_tipoendereco_show
                    if (preg_match('#^/app/tipoendereco/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipoendereco_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_show',));
                    }

                    // admin_app_tipoendereco_acl
                    if (preg_match('#^/app/tipoendereco/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipoendereco_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.tipo_endereco',  '_sonata_name' => 'admin_app_tipoendereco_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tipotelefone')) {
                    // admin_app_tipotelefone_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipotelefone/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_list',  '_route' => 'admin_app_tipotelefone_list',);
                    }

                    // admin_app_tipotelefone_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipotelefone/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_create',  '_route' => 'admin_app_tipotelefone_create',);
                    }

                    // admin_app_tipotelefone_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipotelefone/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_batch',  '_route' => 'admin_app_tipotelefone_batch',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_tipotelefone_edit
                    if (preg_match('#^/app/tipotelefone/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipotelefone_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_edit',));
                    }

                    // admin_app_tipotelefone_delete
                    if (preg_match('#^/app/tipotelefone/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipotelefone_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_delete',));
                    }

                    // admin_app_tipotelefone_show
                    if (preg_match('#^/app/tipotelefone/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipotelefone_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_show',));
                    }

                    // admin_app_tipotelefone_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipotelefone/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_export',  '_route' => 'admin_app_tipotelefone_export',);
                    }

                    // admin_app_tipotelefone_acl
                    if (preg_match('#^/app/tipotelefone/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipotelefone_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.tipo_telefone',  '_sonata_name' => 'admin_app_tipotelefone_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tipodocumento')) {
                    // admin_app_tipodocumento_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipodocumento/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_list',  '_route' => 'admin_app_tipodocumento_list',);
                    }

                    // admin_app_tipodocumento_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipodocumento/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_create',  '_route' => 'admin_app_tipodocumento_create',);
                    }

                    // admin_app_tipodocumento_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipodocumento/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_batch',  '_route' => 'admin_app_tipodocumento_batch',);
                    }

                    // admin_app_tipodocumento_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/tipodocumento/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_export',  '_route' => 'admin_app_tipodocumento_export',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_tipodocumento_edit
                    if (preg_match('#^/app/tipodocumento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipodocumento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_edit',));
                    }

                    // admin_app_tipodocumento_delete
                    if (preg_match('#^/app/tipodocumento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipodocumento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_delete',));
                    }

                    // admin_app_tipodocumento_show
                    if (preg_match('#^/app/tipodocumento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipodocumento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_show',));
                    }

                    // admin_app_tipodocumento_acl
                    if (preg_match('#^/app/tipodocumento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tipodocumento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.tipo_documento',  '_sonata_name' => 'admin_app_tipodocumento_acl',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/unidadefederativa')) {
                // admin_app_unidadefederativa_list
                if ($pathinfo === '/app/'.$perfilLogado.'/unidadefederativa/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_list',  '_route' => 'admin_app_unidadefederativa_list',);
                }

                // admin_app_unidadefederativa_create
                if ($pathinfo === '/app/'.$perfilLogado.'/unidadefederativa/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_create',  '_route' => 'admin_app_unidadefederativa_create',);
                }

                // admin_app_unidadefederativa_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/unidadefederativa/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_batch',  '_route' => 'admin_app_unidadefederativa_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_unidadefederativa_edit
                if (preg_match('#^/app/unidadefederativa/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_unidadefederativa_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_edit',));
                }

                // admin_app_unidadefederativa_delete
                if (preg_match('#^/app/unidadefederativa/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_unidadefederativa_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_delete',));
                }

                // admin_app_unidadefederativa_show
                if (preg_match('#^/app/unidadefederativa/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_unidadefederativa_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_show',));
                }

                // admin_app_unidadefederativa_export
                if ($pathinfo === '/app/'.$perfilLogado.'/unidadefederativa/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_export',  '_route' => 'admin_app_unidadefederativa_export',);
                }

                // admin_app_unidadefederativa_acl
                if (preg_match('#^/app/unidadefederativa/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_unidadefederativa_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.unidade_federativa',  '_sonata_name' => 'admin_app_unidadefederativa_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/homologacaoos')) {
                // admin_app_homologacaoos_list
                if ($pathinfo === '/app/'.$perfilLogado.'/homologacaoos/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_list',  '_route' => 'admin_app_homologacaoos_list',);
                }

                // admin_app_homologacaoos_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/homologacaoos/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_batch',  '_route' => 'admin_app_homologacaoos_batch',);
                }

                // admin_app_homologacaoos_export
                if ($pathinfo === '/app/'.$perfilLogado.'/homologacaoos/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_export',  '_route' => 'admin_app_homologacaoos_export',);
                }


                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_homologacaoos_edit
                if (preg_match('#^/app/homologacaoos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_homologacaoos_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_edit',));
                }

                // admin_app_homologacaoos_show
                if (preg_match('#^/app/homologacaoos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_homologacaoos_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_show',));
                }

                // admin_app_homologacaoos_acl
                if (preg_match('#^/app/homologacaoos/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_homologacaoos_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.homologacao_os',  '_sonata_name' => 'admin_app_homologacaoos_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/filialempresa')) {
                // admin_app_filialempresa_list
                if ($pathinfo === '/app/'.$perfilLogado.'/filialempresa/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_list',  '_route' => 'admin_app_filialempresa_list',);
                }

                // admin_app_filialempresa_create
                if ($pathinfo === '/app/'.$perfilLogado.'/filialempresa/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_create',  '_route' => 'admin_app_filialempresa_create',);
                }

                // admin_app_filialempresa_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/filialempresa/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_batch',  '_route' => 'admin_app_filialempresa_batch',);
                }

                // admin_app_filialempresa_export
                if ($pathinfo === '/app/'.$perfilLogado.'/filialempresa/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_export',  '_route' => 'admin_app_filialempresa_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_filialempresa_edit
                if (preg_match('#^/app/filialempresa/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_filialempresa_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_edit',));
                }

                // admin_app_filialempresa_delete
                if (preg_match('#^/app/filialempresa/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_filialempresa_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_delete',));
                }

                // admin_app_filialempresa_show
                if (preg_match('#^/app/filialempresa/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_filialempresa_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_show',));
                }

                // admin_app_filialempresa_acl
                if (preg_match('#^/app/filialempresa/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_filialempresa_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.filial_empresa',  '_sonata_name' => 'admin_app_filialempresa_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/colaborador')) {
                // admin_app_colaborador_list
                if ($pathinfo === '/app/'.$perfilLogado.'/colaborador/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_list',  '_route' => 'admin_app_colaborador_list',);
                }

                // admin_app_colaborador_create
                if ($pathinfo === '/app/'.$perfilLogado.'/colaborador/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_create',  '_route' => 'admin_app_colaborador_create',);
                }

                // admin_app_colaborador_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/colaborador/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_batch',  '_route' => 'admin_app_colaborador_batch',);
                }

                // admin_app_colaborador_export
                if ($pathinfo === '/app/'.$perfilLogado.'/colaborador/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_export',  '_route' => 'admin_app_colaborador_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_colaborador_edit
                if (preg_match('#^/app/colaborador/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_colaborador_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_edit',));
                }

                // admin_app_colaborador_delete
                if (preg_match('#^/app/colaborador/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_colaborador_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_delete',));
                }

                // admin_app_colaborador_show
                if (preg_match('#^/app/colaborador/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_colaborador_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_show',));
                }

                // admin_app_colaborador_acl
                if (preg_match('#^/app/colaborador/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_colaborador_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.colaborador',  '_sonata_name' => 'admin_app_colaborador_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/fornecedor')) {
                // admin_app_fornecedor_list
                if ($pathinfo === '/app/'.$perfilLogado.'/fornecedor/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_list',  '_route' => 'admin_app_fornecedor_list',);
                }

                // admin_app_fornecedor_create
                if ($pathinfo === '/app/'.$perfilLogado.'/fornecedor/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_create',  '_route' => 'admin_app_fornecedor_create',);
                }

                // admin_app_fornecedor_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/fornecedor/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_batch',  '_route' => 'admin_app_fornecedor_batch',);
                }

                // admin_app_fornecedor_export
                if ($pathinfo === '/app/'.$perfilLogado.'/fornecedor/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_export',  '_route' => 'admin_app_fornecedor_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_fornecedor_edit
                if (preg_match('#^/app/fornecedor/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fornecedor_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_edit',));
                }

                // admin_app_fornecedor_delete
                if (preg_match('#^/app/fornecedor/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fornecedor_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_delete',));
                }

                // admin_app_fornecedor_show
                if (preg_match('#^/app/fornecedor/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fornecedor_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_show',));
                }

                // admin_app_fornecedor_acl
                if (preg_match('#^/app/fornecedor/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fornecedor_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.fornecedor',  '_sonata_name' => 'admin_app_fornecedor_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/empresa')) {
                // admin_app_empresa_list
                if ($pathinfo === '/app/'.$perfilLogado.'/empresa/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_list',  '_route' => 'admin_app_empresa_list',);
                }

                // admin_app_empresa_create
                if ($pathinfo === '/app/'.$perfilLogado.'/empresa/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_create',  '_route' => 'admin_app_empresa_create',);
                }

                // admin_app_empresa_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/empresa/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_batch',  '_route' => 'admin_app_empresa_batch',);
                }

                // admin_app_empresa_export
                if ($pathinfo === '/app/'.$perfilLogado.'/empresa/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_export',  '_route' => 'admin_app_empresa_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_empresa_edit
                if (preg_match('#^/app/empresa/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_empresa_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_edit',));
                }

                // admin_app_empresa_delete
                if (preg_match('#^/app/empresa/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_empresa_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_delete',));
                }

                // admin_app_empresa_show
                if (preg_match('#^/app/empresa/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_empresa_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_show',));
                }

                // admin_app_empresa_acl
                if (preg_match('#^/app/empresa/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_empresa_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.empresa',  '_sonata_name' => 'admin_app_empresa_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/perfil')) {
                // admin_app_perfil_list
                if ($pathinfo === '/app/'.$perfilLogado.'/perfil/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_list',  '_route' => 'admin_app_perfil_list',);
                }

                // admin_app_perfil_create
                if ($pathinfo === '/app/'.$perfilLogado.'/perfil/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_create',  '_route' => 'admin_app_perfil_create',);
                }

                // admin_app_perfil_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/perfil/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_batch',  '_route' => 'admin_app_perfil_batch',);
                }

                // admin_app_perfil_export
                if ($pathinfo === '/app/'.$perfilLogado.'/perfil/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_export',  '_route' => 'admin_app_perfil_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_perfil_edit
                if (preg_match('#^/app/perfil/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_perfil_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_edit',));
                }

                // admin_app_perfil_delete
                if (preg_match('#^/app/perfil/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_perfil_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_delete',));
                }

                // admin_app_perfil_show
                if (preg_match('#^/app/perfil/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_perfil_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_show',));
                }

                // admin_app_perfil_acl
                if (preg_match('#^/app/perfil/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_perfil_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.perfil',  '_sonata_name' => 'admin_app_perfil_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/grupoequipamento')) {
                // admin_app_grupoequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/grupoequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_list',  '_route' => 'admin_app_grupoequipamento_list',);
                }

                // admin_app_grupoequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/grupoequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_create',  '_route' => 'admin_app_grupoequipamento_create',);
                }

                // admin_app_grupoequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/grupoequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_batch',  '_route' => 'admin_app_grupoequipamento_batch',);
                }

                // admin_app_grupoequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/grupoequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_export',  '_route' => 'admin_app_grupoequipamento_export',);
                }


                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_grupoequipamento_edit
                if (preg_match('#^/app/grupoequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_grupoequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_edit',));
                }

                // admin_app_grupoequipamento_delete
                if (preg_match('#^/app/grupoequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_grupoequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_delete',));
                }

                // admin_app_grupoequipamento_show
                if (preg_match('#^/app/grupoequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_grupoequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_show',));
                }

                // admin_app_grupoequipamento_acl
                if (preg_match('#^/app/grupoequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_grupoequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.grupo_equipamento',  '_sonata_name' => 'admin_app_grupoequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ambiente')) {
                // admin_app_ambiente_list
                if ($pathinfo === '/app/'.$perfilLogado.'/ambiente/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_list',  '_route' => 'admin_app_ambiente_list',);
                }

                // admin_app_ambiente_create
                if ($pathinfo === '/app/'.$perfilLogado.'/ambiente/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_create',  '_route' => 'admin_app_ambiente_create',);
                }

                // admin_app_ambiente_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/ambiente/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_batch',  '_route' => 'admin_app_ambiente_batch',);
                }

                // admin_app_ambiente_export
                if ($pathinfo === '/app/'.$perfilLogado.'/ambiente/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_export',  '_route' => 'admin_app_ambiente_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_ambiente_edit
                if (preg_match('#^/app/ambiente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambiente_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_edit',));
                }

                // admin_app_ambiente_delete
                if (preg_match('#^/app/ambiente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambiente_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_delete',));
                }

                // admin_app_ambiente_show
                if (preg_match('#^/app/ambiente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambiente_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_show',));
                }

                // admin_app_ambiente_acl
                if (preg_match('#^/app/ambiente/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambiente_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.ambiente',  '_sonata_name' => 'admin_app_ambiente_acl',));
                }

            }

//            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ambienteequipamento')) {
//                // admin_app_ambienteequipamento_list
//                if ($pathinfo === '/app/'.$perfilLogado.'/ambienteequipamento/list') {
//                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_list',  '_route' => 'admin_app_ambienteequipamento_list',);
//                }
//
//                // admin_app_ambienteequipamento_create
//                if ($pathinfo === '/app/'.$perfilLogado.'/ambienteequipamento/create') {
//                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_create',  '_route' => 'admin_app_ambienteequipamento_create',);
//                }
//
//                // admin_app_ambienteequipamento_batch
//                if ($pathinfo === '/app/'.$perfilLogado.'/ambienteequipamento/batch') {
//                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_batch',  '_route' => 'admin_app_ambienteequipamento_batch',);
//                }
//
//                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);
//
//                // admin_app_ambienteequipamento_edit
//                if (preg_match('#^/app/ambienteequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
//                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambienteequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_edit',));
//                }
//
//                // admin_app_ambienteequipamento_delete
//                if (preg_match('#^/app/ambienteequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
//                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambienteequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_delete',));
//                }
//
//                // admin_app_ambienteequipamento_show
//                if (preg_match('#^/app/ambienteequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
//                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambienteequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_show',));
//                }
//
//                // admin_app_ambienteequipamento_export
//                if ($pathinfo === '/app/'.$perfilLogado.'/ambienteequipamento/export') {
//                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_export',  '_route' => 'admin_app_ambienteequipamento_export',);
//                }
//
//                // admin_app_ambienteequipamento_acl
//                if (preg_match('#^/app/ambienteequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
//                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ambienteequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.ambiente_equipamento',  '_sonata_name' => 'admin_app_ambienteequipamento_acl',));
//                }
//
//            }


            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/cliente')) {
                // admin_app_cliente_list
                if ($pathinfo === '/app/'.$perfilLogado.'/cliente/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::listAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_list',  '_route' => 'admin_app_cliente_list',);
                }

                // admin_app_cliente_create
                if ($pathinfo === '/app/'.$perfilLogado.'/cliente/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::createAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_create',  '_route' => 'admin_app_cliente_create',);
                }

                // admin_app_cliente_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/cliente/batch') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::batchAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_batch',  '_route' => 'admin_app_cliente_batch',);
                }

                // admin_app_cliente_export
                if ($pathinfo === '/app/'.$perfilLogado.'/cliente/export') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::exportAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_export',  '_route' => 'admin_app_cliente_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_cliente_edit
                if (preg_match('#^/app/cliente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cliente_edit')), array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::editAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_edit',));
                }

                // admin_app_cliente_show
                if (preg_match('#^/app/cliente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cliente_show')), array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::showAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_show',));
                }


                // admin_app_cliente_acl
                if (preg_match('#^/app/cliente/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cliente_acl')), array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::aclAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_acl',));
                }

                // admin_app_cliente_etiqueta
                if (preg_match('#^/app/cliente/(?P<id>[^/]++)/etiqueta$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_cliente_etiqueta')), array (  '_controller' => 'AppBundle\\Controller\\ClienteCRUDController::etiquetaAction',  '_sonata_admin' => 'app.admin.cliente',  '_sonata_name' => 'admin_app_cliente_etiqueta',));
                }

            }


            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/equipamentocliente')) {

                // admin_app_equipamentocliente_list
                if ($pathinfo === '/app/'.$perfilLogado.'/equipamentocliente/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_list',  '_route' => 'admin_app_equipamentocliente_list',);
                }

                // admin_app_equipamentocliente_create
                if ($pathinfo === '/app/'.$perfilLogado.'/equipamentocliente/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_create',  '_route' => 'admin_app_equipamentocliente_create',);
                }

                // admin_app_equipamentocliente_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/equipamentocliente/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_batch',  '_route' => 'admin_app_equipamentocliente_batch',);
                }

                // admin_app_equipamentocliente_export
                if ($pathinfo === '/app/'.$perfilLogado.'/equipamentocliente/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_export',  '_route' => 'admin_app_equipamentocliente_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_equipamentocliente_edit
                if (preg_match('#^/app/equipamentocliente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_equipamentocliente_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_edit',));
                }

                // admin_app_equipamentocliente_delete
                if (preg_match('#^/app/equipamentocliente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_equipamentocliente_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_delete',));
                }

                // admin_app_equipamentocliente_show
                if (preg_match('#^/app/equipamentocliente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_equipamentocliente_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_show',));
                }

                // admin_app_equipamentocliente_acl
                if (preg_match('#^/app/equipamentocliente/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_equipamentocliente_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.equipamento_cliente',  '_sonata_name' => 'admin_app_equipamentocliente_acl',));
                }

            }

            if(0 === strpos($pathinfo, '/app/clienteequipamento')){

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_clienteequipamento_edit
                if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_edit')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_edit',));
                }

                // admin_app_clienteequipamento_show
                if (($pos = strpos($pathinfo, "&")) !== FALSE) {
                    $pathinfo = substr($pathinfo, 0, $pos);
                    if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_show')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_show',));
                    }
                }else{
                    if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_show')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_show',));
                    }
                }

                // admin_app_clienteequipamento_acl
                if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_acl')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_acl',));
                }
            }

            if(substr($pathinfo,0,5).substr($pathinfo,5,19) == '/app/clienteequipamento/') {

                $pathinfo = substr($pathinfo,0,5).$perfilLogado.'/'.substr($pathinfo,5);


                if (0 === strpos($pathinfo, '/app/'.$perfilLogado .'/clienteequipamento')) {
                    // admin_app_clienteequipamento_list
                    if ($pathinfo === '/app/'.$perfilLogado .'/clienteequipamento/list') {
                        return array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_list', '_route' => 'admin_app_clienteequipamento_list',);
                    }

                    // admin_app_clienteequipamento_create
                    if ($pathinfo === '/app/'.$perfilLogado .'/clienteequipamento/create') {
                        return array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_create', '_route' => 'admin_app_clienteequipamento_create',);
                    }

                    // admin_app_clienteequipamento_batch
                    if ($pathinfo === '/app/'.$perfilLogado .'/clienteequipamento/batch') {
                        return array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_batch', '_route' => 'admin_app_clienteequipamento_batch',);
                    }

//                    $pathinfo = substr($pathinfo, 0, 5) . substr($pathinfo, 14);
//
//                    // admin_app_clienteequipamento_edit
//                    if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
//                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_edit')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_edit',));
//                    }
//
//                    // admin_app_clienteequipamento_show
//                    if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
//                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_show')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_show',));
//                    }
//
//                    // admin_app_clienteequipamento_export
//                    if ($pathinfo === '/app/'.$perfilLogado .'/clienteequipamento/export') {
//                        return array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_export', '_route' => 'admin_app_clienteequipamento_export',);
//                    }
//
//                    // admin_app_clienteequipamento_acl
//                    if (preg_match('#^/app/clienteequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
//                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamento_acl')), array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction', '_sonata_admin' => 'app.admin.cliente_equipamento', '_sonata_name' => 'admin_app_clienteequipamento_acl',));
//                    }

                }
            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/responsavelcliente')) {
                // admin_app_responsavelcliente_list
                if ($pathinfo === '/app/'.$perfilLogado.'/responsavelcliente/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_list',  '_route' => 'admin_app_responsavelcliente_list',);
                }

                // admin_app_responsavelcliente_create
                if ($pathinfo === '/app/'.$perfilLogado.'/responsavelcliente/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_create',  '_route' => 'admin_app_responsavelcliente_create',);
                }

                // admin_app_responsavelcliente_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/responsavelcliente/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_batch',  '_route' => 'admin_app_responsavelcliente_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_responsavelcliente_edit
                if (preg_match('#^/app/responsavelcliente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_responsavelcliente_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_edit',));
                }

                // admin_app_responsavelcliente_delete
                if (preg_match('#^/app/responsavelcliente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_responsavelcliente_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_delete',));
                }

                // admin_app_responsavelcliente_show
                if (preg_match('#^/app/responsavelcliente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_responsavelcliente_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_show',));
                }

                // admin_app_responsavelcliente_export
                if ($pathinfo === '/app/'.$perfilLogado.'/responsavelcliente/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_export',  '_route' => 'admin_app_responsavelcliente_export',);
                }

                // admin_app_responsavelcliente_acl
                if (preg_match('#^/app/responsavelcliente/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_responsavelcliente_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.responsavel_cliente',  '_sonata_name' => 'admin_app_responsavelcliente_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/usuariocliente')) {
                // admin_app_usuariocliente_list
                if ($pathinfo === '/app/'.$perfilLogado.'/usuariocliente/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_list',  '_route' => 'admin_app_usuariocliente_list',);
                }

                // admin_app_usuariocliente_create
                if ($pathinfo === '/app/'.$perfilLogado.'/usuariocliente/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_create',  '_route' => 'admin_app_usuariocliente_create',);
                }

                // admin_app_usuariocliente_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/usuariocliente/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_batch',  '_route' => 'admin_app_usuariocliente_batch',);
                }

                // admin_app_usuariocliente_export
                if ($pathinfo === '/app/'.$perfilLogado.'/usuariocliente/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_export',  '_route' => 'admin_app_usuariocliente_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_usuariocliente_edit
                if (preg_match('#^/app/usuariocliente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_usuariocliente_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_edit',));
                }

                // admin_app_usuariocliente_delete
                if (preg_match('#^/app/usuariocliente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_usuariocliente_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_delete',));
                }

                // admin_app_usuariocliente_show
                if (preg_match('#^/app/usuariocliente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_usuariocliente_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_show',));
                }

                // admin_app_usuariocliente_acl
                if (preg_match('#^/app/usuariocliente/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_usuariocliente_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.usuario_cliente',  '_sonata_name' => 'admin_app_usuariocliente_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/produto')) {
                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/produtoestoque')) {
                    // admin_app_produtoestoque_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoestoque/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_list',  '_route' => 'admin_app_produtoestoque_list',);
                    }

                    // admin_app_produtoestoque_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoestoque/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_batch',  '_route' => 'admin_app_produtoestoque_batch',);
                    }

                    // admin_app_produtoestoque_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoestoque/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_export',  '_route' => 'admin_app_produtoestoque_export',);
                    }


                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_produtoestoque_edit
                    if (preg_match('#^/app/produtoestoque/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoestoque_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_edit',));
                    }

                    // admin_app_produtoestoque_delete
                    if (preg_match('#^/app/produtoestoque/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoestoque_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_delete',));
                    }

                    // admin_app_produtoestoque_show
                    if (preg_match('#^/app/produtoestoque/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoestoque_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_show',));
                    }

                    // admin_app_produtoestoque_acl
                    if (preg_match('#^/app/produtoestoque/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoestoque_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.produto_estoque',  '_sonata_name' => 'admin_app_produtoestoque_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/produtoalmoxarifado')) {
                    // admin_app_produtoalmoxarifado_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoalmoxarifado/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_list',  '_route' => 'admin_app_produtoalmoxarifado_list',);
                    }

                    // admin_app_produtoalmoxarifado_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoalmoxarifado/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_create',  '_route' => 'admin_app_produtoalmoxarifado_create',);
                    }

                    // admin_app_produtoalmoxarifado_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoalmoxarifado/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_batch',  '_route' => 'admin_app_produtoalmoxarifado_batch',);
                    }

                    // admin_app_produtoalmoxarifado_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/produtoalmoxarifado/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_export',  '_route' => 'admin_app_produtoalmoxarifado_export',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_produtoalmoxarifado_edit
                    if (preg_match('#^/app/produtoalmoxarifado/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoalmoxarifado_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_edit',));
                    }

                    // admin_app_produtoalmoxarifado_delete
                    if (preg_match('#^/app/produtoalmoxarifado/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoalmoxarifado_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_delete',));
                    }

                    // admin_app_produtoalmoxarifado_show
                    if (preg_match('#^/app/produtoalmoxarifado/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoalmoxarifado_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_show',));
                    }

                    // admin_app_produtoalmoxarifado_acl
                    if (preg_match('#^/app/produtoalmoxarifado/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtoalmoxarifado_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.produto_almoxarifado',  '_sonata_name' => 'admin_app_produtoalmoxarifado_acl',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ferramentaalmoxarifado')) {
                // admin_app_ferramentaalmoxarifado_list
                if ($pathinfo === '/app/'.$perfilLogado.'/ferramentaalmoxarifado/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_list',  '_route' => 'admin_app_ferramentaalmoxarifado_list',);
                }

                // admin_app_ferramentaalmoxarifado_create
                if ($pathinfo === '/app/'.$perfilLogado.'/ferramentaalmoxarifado/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_create',  '_route' => 'admin_app_ferramentaalmoxarifado_create',);
                }

                // admin_app_ferramentaalmoxarifado_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/ferramentaalmoxarifado/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_batch',  '_route' => 'admin_app_ferramentaalmoxarifado_batch',);
                }

                // admin_app_ferramentaalmoxarifado_export
                if ($pathinfo === '/app/'.$perfilLogado.'/ferramentaalmoxarifado/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_export',  '_route' => 'admin_app_ferramentaalmoxarifado_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_ferramentaalmoxarifado_edit
                if (preg_match('#^/app/ferramentaalmoxarifado/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ferramentaalmoxarifado_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_edit',));
                }

                // admin_app_ferramentaalmoxarifado_delete
                if (preg_match('#^/app/ferramentaalmoxarifado/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ferramentaalmoxarifado_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_delete',));
                }

                // admin_app_ferramentaalmoxarifado_show
                if (preg_match('#^/app/ferramentaalmoxarifado/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ferramentaalmoxarifado_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_show',));
                }


                // admin_app_ferramentaalmoxarifado_acl
                if (preg_match('#^/app/ferramentaalmoxarifado/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ferramentaalmoxarifado_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.ferramenta_almoxarifado',  '_sonata_name' => 'admin_app_ferramentaalmoxarifado_acl',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/'.$perfilLogado.'/entradaprodutosemnota')) {

            // admin_app_entradaproduto_list
            if ($pathinfo === '/'.$perfilLogado.'/entradaprodutosemnota/list') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_list',  '_route' => 'admin_app_entradaproduto_list',);
            }

            // admin_app_entradaproduto_create
            if ($pathinfo === '/'.$perfilLogado.'/entradaprodutosemnota/create') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_create',  '_route' => 'admin_app_entradaproduto_create',);
            }

            // admin_app_entradaproduto_batch
            if ($pathinfo === '/'.$perfilLogado.'/entradaprodutosemnota/batch') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_batch',  '_route' => 'admin_app_entradaproduto_batch',);
            }

            // admin_app_entradaproduto_export
            if ($pathinfo === '/'.$perfilLogado.'/entradaprodutosemnota/export') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_export',  '_route' => 'admin_app_entradaproduto_export',);
            }

            $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

            // admin_app_entradaproduto_edit
            if (preg_match('#^/entradaprodutosemnota/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_entradaproduto_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_edit',));
            }

            // admin_app_entradaproduto_delete
            if (preg_match('#^/entradaprodutosemnota/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_entradaproduto_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_delete',));
            }

            // admin_app_entradaproduto_show
            if (preg_match('#^/entradaprodutosemnota/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_entradaproduto_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_show',));
            }

            // admin_app_entradaproduto_acl
            if (preg_match('#^/entradaprodutosemnota/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_entradaproduto_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.entrada_produto_sem_nota',  '_sonata_name' => 'admin_app_entradaproduto_acl',));
            }

        }

        if (0 === strpos($pathinfo, '/app')) {
            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/entradaproduto')) {
                // entradaproduto_list
                if ($pathinfo === '/app/'.$perfilLogado.'/entradaproduto/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_list',  '_route' => 'entradaproduto_list',);
                }

                // entradaproduto_create
                if ($pathinfo === '/app/'.$perfilLogado.'/entradaproduto/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_create',  '_route' => 'entradaproduto_create',);
                }

                // entradaproduto_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/entradaproduto/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_batch',  '_route' => 'entradaproduto_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // entradaproduto_edit
                if (preg_match('#^/app/entradaproduto/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'entradaproduto_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_edit',));
                }

                // entradaproduto_delete
                if (preg_match('#^/app/entradaproduto/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'entradaproduto_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_delete',));
                }

                // entradaproduto_show
                if (preg_match('#^/app/entradaproduto/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'entradaproduto_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_show',));
                }

                // entradaproduto_export
                if ($pathinfo === '/app/'.$perfilLogado.'/entradaproduto/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_export',  '_route' => 'entradaproduto_export',);
                }

                // entradaproduto_acl
                if (preg_match('#^/app/entradaproduto/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'entradaproduto_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.entrada_produto',  '_sonata_name' => 'entradaproduto_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/produtosolicitacao')) {
                // admin_app_produtosolicitacao_list
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosolicitacao/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_list',  '_route' => 'admin_app_produtosolicitacao_list',);
                }

                // admin_app_produtosolicitacao_create
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosolicitacao/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_create',  '_route' => 'admin_app_produtosolicitacao_create',);
                }

                // admin_app_produtosolicitacao_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosolicitacao/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_batch',  '_route' => 'admin_app_produtosolicitacao_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_produtosolicitacao_edit
                if (preg_match('#^/app/produtosolicitacao/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosolicitacao_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_edit',));
                }

                // admin_app_produtosolicitacao_delete
                if (preg_match('#^/app/produtosolicitacao/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosolicitacao_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_delete',));
                }

                // admin_app_produtosolicitacao_show
                if (preg_match('#^/app/produtosolicitacao/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosolicitacao_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_show',));
                }

                // admin_app_produtosolicitacao_export
                if ($pathinfo === '/app/'.$perfilLogado.'/produtosolicitacao/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_export',  '_route' => 'admin_app_produtosolicitacao_export',);
                }

                // admin_app_produtosolicitacao_acl
                if (preg_match('#^/app/produtosolicitacao/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_produtosolicitacao_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.produto_solicitacao',  '_sonata_name' => 'admin_app_produtosolicitacao_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/requisicaoproduto')) {
                // admin_app_requisicaoproduto_list
                if ($pathinfo === '/app/'.$perfilLogado.'/requisicaoproduto/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.requisicao_produto',  '_sonata_name' => 'admin_app_requisicaoproduto_list',  '_route' => 'admin_app_requisicaoproduto_list',);
                }

                    // admin_app_requisicaoproduto_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/requisicaoproduto/create') {
                        return array('_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction', '_sonata_admin' =>'app.admin.requisicao_produto', '_sonata_name' => 'admin_app_requisicaoproduto_create', '_route' => 'admin_app_requisicaoproduto_create',);
                    }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_requisicaoproduto_show
                if (preg_match('#^/app/requisicaoproduto/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_requisicaoproduto_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.requisicao_produto',  '_sonata_name' => 'admin_app_requisicaoproduto_show',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/or')) {
                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/orcamentoproduto')) {
                    // admin_app_orcamentoproduto_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/orcamentoproduto/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::listAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_list',  '_route' => 'admin_app_orcamentoproduto_list',);
                    }

                    // admin_app_orcamentoproduto_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/orcamentoproduto/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::createAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_create',  '_route' => 'admin_app_orcamentoproduto_create',);
                    }

                    // admin_app_orcamentoproduto_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/orcamentoproduto/batch') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::batchAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_batch',  '_route' => 'admin_app_orcamentoproduto_batch',);
                    }

                    // admin_app_orcamentoproduto_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/orcamentoproduto/export') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::exportAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_export',  '_route' => 'admin_app_orcamentoproduto_export',);
                    }


                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_orcamentoproduto_edit
                    if (preg_match('#^/app/orcamentoproduto/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_orcamentoproduto_edit')), array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::editAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_edit',));
                    }

                    // admin_app_orcamentoproduto_show
                    if (preg_match('#^/app/orcamentoproduto/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_orcamentoproduto_show')), array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::showAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_show',));
                    }

                    // admin_app_orcamentoproduto_acl
                    if (preg_match('#^/app/orcamentoproduto/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_orcamentoproduto_acl')), array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::aclAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_acl',));
                    }

                    // admin_app_orcamentoproduto_print
                    if (preg_match('#^/app/orcamentoproduto/(?P<id>[^/]++)/print$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_orcamentoproduto_print')), array (  '_controller' => 'AppBundle\\Controller\\PdfCRUDController::printAction',  '_sonata_admin' => 'app.admin.orcamento_produto',  '_sonata_name' => 'admin_app_orcamentoproduto_print',));
                    }

                }

                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ordem')) {
                    if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ordemcompraproduto')) {
                        // admin_app_ordemcompraproduto_list
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemcompraproduto/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_list',  '_route' => 'admin_app_ordemcompraproduto_list',);
                        }

                        // admin_app_ordemcompraproduto_create
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemcompraproduto/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_create',  '_route' => 'admin_app_ordemcompraproduto_create',);
                        }

                        // admin_app_ordemcompraproduto_batch
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemcompraproduto/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_batch',  '_route' => 'admin_app_ordemcompraproduto_batch',);
                        }

                        // admin_app_ordemcompraproduto_export
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemcompraproduto/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDConController::exportAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_export',  '_route' => 'admin_app_ordemcompraproduto_export',);
                        }


                        $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                        // admin_app_ordemcompraproduto_edit
                        if (preg_match('#^/app/ordemcompraproduto/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemcompraproduto_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_edit',));
                        }

                        // admin_app_ordemcompraproduto_show
                        if (preg_match('#^/app/ordemcompraproduto/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemcompraproduto_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_show',));
                        }

                        // admin_app_ordemcompraproduto_acl
                        if (preg_match('#^/app/ordemcompraproduto/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemcompraproduto_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_acl',));
                        }

                        // admin_app_ordemcompraproduto_print
                        if (preg_match('#^/app/ordemcompraproduto/(?P<id>[^/]++)/print$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemcompraproduto_print')), array (  '_controller' => 'Sonata\\AdminBundle\\CRUDController::printAction',  '_sonata_admin' => 'app.admin.ordem_compra_produto',  '_sonata_name' => 'admin_app_ordemcompraproduto_print',));
                        }
                    }

                    if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/ordemservico')) {
                        // ordens-de-servico_list
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemservico/list') {
                            return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::listAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_list',  '_route' => 'ordens-de-servico_list',);
                        }

                        // ordens-de-servico_create
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemservico/create') {
                            return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::createAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_create',  '_route' => 'ordens-de-servico_create',);
                        }

                        // ordens-de-servico_batch
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemservico/batch') {
                            return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::batchAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_batch',  '_route' => 'ordens-de-servico_batch',);
                        }

                        // ordens-de-servico_export
                        if ($pathinfo === '/app/'.$perfilLogado.'/ordemservico/export') {
                            return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::exportAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_export',  '_route' => 'ordens-de-servico_export',);
                        }


                        $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                        // ordens-de-servico_edit
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_edit')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::editAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_edit',));
                        }

                        // ordens-de-servico_show
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_show')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::showAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_show',));
                        }

                        // ordens-de-servico_acl
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_acl')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::aclAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_acl',));
                        }

                        // ordens-de-servico_homologa
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/homologa$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_homologa')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::homologaAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_homologa',));
                        }

                        // ordens-de-servico_print
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/print$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_print')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::printAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_print',));
                        }

                        // ordens-de-servico_cancela
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/cancela$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_cancela')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::cancelaAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_cancela',));
                        }

                        // ordens-de-servico_historico
                        if (preg_match('#^/app/ordemservico/(?P<id>[^/]++)/historico$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ordens-de-servico_historico')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::historicoAction',  '_sonata_admin' => 'app.admin.ordem_servico',  '_sonata_name' => 'ordens-de-servico_historico',));
                        }
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/'.$perfilLogado.'/ordens-de-servico-homologadas')) {
            // admin_app_ordemservico_list
            if ($pathinfo === '/'.$perfilLogado.'/ordens-de-servico-homologadas/list') {
                return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::listAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_list',  '_route' => 'admin_app_ordemservico_list',);
            }

            // admin_app_ordemservico_create
            if ($pathinfo === '/'.$perfilLogado.'/ordens-de-servico-homologadas/create') {
                return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::createAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_create',  '_route' => 'admin_app_ordemservico_create',);
            }

            // admin_app_ordemservico_batch
            if ($pathinfo === '/'.$perfilLogado.'/ordens-de-servico-homologadas/batch') {
                return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::batchAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_batch',  '_route' => 'admin_app_ordemservico_batch',);
            }

            // admin_app_ordemservico_export
            if ($pathinfo === '/'.$perfilLogado.'/ordens-de-servico-homologadas/export') {
                return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::exportAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_export',  '_route' => 'admin_app_ordemservico_export',);
            }

            $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

            // admin_app_ordemservico_edit
            if (preg_match('#^/ordens\\-de\\-servico\\-homologadas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemservico_edit')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::editAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_edit',));
            }

            // admin_app_ordemservico_show
            if (preg_match('#^/ordens\\-de\\-servico\\-homologadas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemservico_show')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::showAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_show',));
            }

            // admin_app_ordemservico_acl
            if (preg_match('#^/ordens\\-de\\-servico\\-homologadas/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemservico_acl')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::aclAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_acl',));
            }

            // admin_app_ordemservico_relatoriopmoc
            if (preg_match('#^/ordens\\-de\\-servico\\-homologadas/(?P<id>[^/]++)/relatoriopmoc$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemservico_relatoriopmoc')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::relatoriopmocAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_relatoriopmoc',));
            }

            // admin_app_ordemservico_deshomologa
            if (preg_match('#^/ordens\\-de\\-servico\\-homologadas/(?P<id>[^/]++)/deshomologa$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_ordemservico_deshomologa')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::deshomologaAction',  '_sonata_admin' => 'app.admin.ordem_servico_homologadas',  '_sonata_name' => 'admin_app_ordemservico_deshomologa',));
            }

        }

        if (0 === strpos($pathinfo, '/app')) {
            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/agendamentoordemservico')) {
                // admin_app_agendamentoordemservico_list
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentoordemservico/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::listAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_list',  '_route' => 'admin_app_agendamentoordemservico_list',);
                }

                // admin_app_agendamentoordemservico_create
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentoordemservico/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::createAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_create',  '_route' => 'admin_app_agendamentoordemservico_create',);
                }

                // admin_app_agendamentoordemservico_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentoordemservico/batch') {
                    return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::batchAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_batch',  '_route' => 'admin_app_agendamentoordemservico_batch',);
                }


                // admin_app_agendamentoordemservico_export
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentoordemservico/export') {
                    return array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::exportAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_export',  '_route' => 'admin_app_agendamentoordemservico_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_agendamentoordemservico_edit
                if (preg_match('#^/app/agendamentoordemservico/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentoordemservico_edit')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::editAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_edit',));
                }

                // admin_app_agendamentoordemservico_delete
                if (preg_match('#^/app/agendamentoordemservico/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentoordemservico_delete')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::deleteAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_delete',));
                }

                // admin_app_agendamentoordemservico_show
                if (preg_match('#^/app/agendamentoordemservico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentoordemservico_show')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::showAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_show',));
                }


                // admin_app_agendamentoordemservico_acl
                if (preg_match('#^/app/agendamentoordemservico/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentoordemservico_acl')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::aclAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_acl',));
                }

                // admin_app_agendamentoordemservico_print
                if (preg_match('#^/app/agendamentoordemservico/(?P<id>[^/]++)/print$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentoordemservico_print')), array (  '_controller' => 'AppBundle\\Controller\\OsCRUDController::printAction',  '_sonata_admin' => 'app.admin.agendamento_ordem_servico',  '_sonata_name' => 'admin_app_agendamentoordemservico_print',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/relatorioordemservico')) {
                // admin_app_relatorioordemservico_list
                if ($pathinfo === '/app/'.$perfilLogado.'/relatorioordemservico/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.relatorio_ordem_servico',  '_sonata_name' => 'admin_app_relatorioordemservico_list',  '_route' => 'admin_app_relatorioordemservico_list',);
                }

                // admin_app_relatorioordemservico_create
                if ($pathinfo === '/app/'.$perfilLogado.'/relatorioordemservico/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.relatorio_ordem_servico',  '_sonata_name' => 'admin_app_relatorioordemservico_create',  '_route' => 'admin_app_relatorioordemservico_create',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_relatorioordemservico_edit
                if (preg_match('#^/app/relatorioordemservico/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_relatorioordemservico_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.relatorio_ordem_servico',  '_sonata_name' => 'admin_app_relatorioordemservico_edit',));
                }

                // admin_app_relatorioordemservico_show
                if (preg_match('#^/app/relatorioordemservico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_relatorioordemservico_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.relatorio_ordem_servico',  '_sonata_name' => 'admin_app_relatorioordemservico_show',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/fotoos')) {
                // admin_app_fotoos_list
                if ($pathinfo === '/app/'.$perfilLogado.'/fotoos/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_list',  '_route' => 'admin_app_fotoos_list',);
                }

                // admin_app_fotoos_create
                if ($pathinfo === '/app/'.$perfilLogado.'/fotoos/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_create',  '_route' => 'admin_app_fotoos_create',);
                }

                // admin_app_fotoos_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/fotoos/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_batch',  '_route' => 'admin_app_fotoos_batch',);
                }

                // admin_app_fotoos_export
                if ($pathinfo === '/app/'.$perfilLogado.'/fotoos/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_export',  '_route' => 'admin_app_fotoos_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_fotoos_edit
                if (preg_match('#^/app/fotoos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fotoos_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_edit',));
                }

                // admin_app_fotoos_delete
                if (preg_match('#^/app/fotoos/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fotoos_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_delete',));
                }

                // admin_app_fotoos_show
                if (preg_match('#^/app/fotoos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fotoos_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_show',));
                }


                // admin_app_fotoos_acl
                if (preg_match('#^/app/fotoos/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fotoos_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.fotoos',  '_sonata_name' => 'admin_app_fotoos_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/m')) {
                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/modeloequipamento')) {
                    // admin_app_modeloequipamento_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/modeloequipamento/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_list',  '_route' => 'admin_app_modeloequipamento_list',);
                    }

                    // admin_app_modeloequipamento_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/modeloequipamento/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_create',  '_route' => 'admin_app_modeloequipamento_create',);
                    }

                    // admin_app_modeloequipamento_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/modeloequipamento/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_batch',  '_route' => 'admin_app_modeloequipamento_batch',);
                    }

                    // admin_app_modeloequipamento_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/modeloequipamento/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_export',  '_route' => 'admin_app_modeloequipamento_export',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_modeloequipamento_edit
                    if (preg_match('#^/app/modeloequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_modeloequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_edit',));
                    }

                    // admin_app_modeloequipamento_delete
                    if (preg_match('#^/app/modeloequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_modeloequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_delete',));
                    }

                    // admin_app_modeloequipamento_show
                    if (preg_match('#^/app/modeloequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_modeloequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_show',));
                    }

                    // admin_app_modeloequipamento_acl
                    if (preg_match('#^/app/modeloequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_modeloequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.modelo_equipamento',  '_sonata_name' => 'admin_app_modeloequipamento_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/marcaequipamento')) {
                    // admin_app_marcaequipamento_list
                    if ($pathinfo === '/app/'.$perfilLogado.'/marcaequipamento/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_list',  '_route' => 'admin_app_marcaequipamento_list',);
                    }

                    // admin_app_marcaequipamento_create
                    if ($pathinfo === '/app/'.$perfilLogado.'/marcaequipamento/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_create',  '_route' => 'admin_app_marcaequipamento_create',);
                    }

                    // admin_app_marcaequipamento_batch
                    if ($pathinfo === '/app/'.$perfilLogado.'/marcaequipamento/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_batch',  '_route' => 'admin_app_marcaequipamento_batch',);
                    }

                    // admin_app_marcaequipamento_export
                    if ($pathinfo === '/app/'.$perfilLogado.'/marcaequipamento/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_export',  '_route' => 'admin_app_marcaequipamento_export',);
                    }

                    $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                    // admin_app_marcaequipamento_edit
                    if (preg_match('#^/app/marcaequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_marcaequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_edit',));
                    }

                    // admin_app_marcaequipamento_delete
                    if (preg_match('#^/app/marcaequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_marcaequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_delete',));
                    }

                    // admin_app_marcaequipamento_show
                    if (preg_match('#^/app/marcaequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_marcaequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_show',));
                    }

                    // admin_app_marcaequipamento_acl
                    if (preg_match('#^/app/marcaequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_marcaequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.marca_equipamento',  '_sonata_name' => 'admin_app_marcaequipamento_acl',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/titulovalorpropriedadeequipamento')) {
                // admin_app_titulovalorpropriedadeequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/titulovalorpropriedadeequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_list',  '_route' => 'admin_app_titulovalorpropriedadeequipamento_list',);
                }

                // admin_app_titulovalorpropriedadeequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/titulovalorpropriedadeequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_create',  '_route' => 'admin_app_titulovalorpropriedadeequipamento_create',);
                }

                // admin_app_titulovalorpropriedadeequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/titulovalorpropriedadeequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_batch',  '_route' => 'admin_app_titulovalorpropriedadeequipamento_batch',);
                }

                // admin_app_titulovalorpropriedadeequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/titulovalorpropriedadeequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_export',  '_route' => 'admin_app_titulovalorpropriedadeequipamento_export',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_titulovalorpropriedadeequipamento_edit
                if (preg_match('#^/app/titulovalorpropriedadeequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulovalorpropriedadeequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_edit',));
                }

                // admin_app_titulovalorpropriedadeequipamento_delete
                if (preg_match('#^/app/titulovalorpropriedadeequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulovalorpropriedadeequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_delete',));
                }

                // admin_app_titulovalorpropriedadeequipamento_show
                if (preg_match('#^/app/titulovalorpropriedadeequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulovalorpropriedadeequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_show',));
                }


                // admin_app_titulovalorpropriedadeequipamento_acl
                if (preg_match('#^/app/titulovalorpropriedadeequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulovalorpropriedadeequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.titulo_valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulovalorpropriedadeequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/valorpropriedadeequipamento')) {
                // admin_app_valorpropriedadeequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/valorpropriedadeequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_list',  '_route' => 'admin_app_valorpropriedadeequipamento_list',);
                }

                // admin_app_valorpropriedadeequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/valorpropriedadeequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_create',  '_route' => 'admin_app_valorpropriedadeequipamento_create',);
                }

                // admin_app_valorpropriedadeequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/valorpropriedadeequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_batch',  '_route' => 'admin_app_valorpropriedadeequipamento_batch',);
                }

                // admin_app_valorpropriedadeequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/valorpropriedadeequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_export',  '_route' => 'admin_app_valorpropriedadeequipamento_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_valorpropriedadeequipamento_edit
                if (preg_match('#^/app/valorpropriedadeequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_valorpropriedadeequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_edit',));
                }

                // admin_app_valorpropriedadeequipamento_delete
                if (preg_match('#^/app/valorpropriedadeequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_valorpropriedadeequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_delete',));
                }

                // admin_app_valorpropriedadeequipamento_show
                if (preg_match('#^/app/valorpropriedadeequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_valorpropriedadeequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_show',));
                }

                // admin_app_valorpropriedadeequipamento_acl
                if (preg_match('#^/app/valorpropriedadeequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_valorpropriedadeequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.valor_propriedade_equipamento',  '_sonata_name' => 'admin_app_valorpropriedadeequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/titulopropriedadeequipamento')) {
                // admin_app_titulopropriedadeequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/titulopropriedadeequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_list',  '_route' => 'admin_app_titulopropriedadeequipamento_list',);
                }

                // admin_app_titulopropriedadeequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/titulopropriedadeequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_create',  '_route' => 'admin_app_titulopropriedadeequipamento_create',);
                }

                // admin_app_titulopropriedadeequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/titulopropriedadeequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_batch',  '_route' => 'admin_app_titulopropriedadeequipamento_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_titulopropriedadeequipamento_edit
                if (preg_match('#^/app/titulopropriedadeequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulopropriedadeequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_edit',));
                }

                // admin_app_titulopropriedadeequipamento_delete
                if (preg_match('#^/app/titulopropriedadeequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulopropriedadeequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_delete',));
                }

                // admin_app_titulopropriedadeequipamento_show
                if (preg_match('#^/app/titulopropriedadeequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulopropriedadeequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_show',));
                }

                // admin_app_titulopropriedadeequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/titulopropriedadeequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_export',  '_route' => 'admin_app_titulopropriedadeequipamento_export',);
                }

                // admin_app_titulopropriedadeequipamento_acl
                if (preg_match('#^/app/titulopropriedadeequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_titulopropriedadeequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.titulo_propriedade_equipamento',  '_sonata_name' => 'admin_app_titulopropriedadeequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/propriedadeequipamento')) {
                // admin_app_propriedadeequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/propriedadeequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_list',  '_route' => 'admin_app_propriedadeequipamento_list',);
                }

                // admin_app_propriedadeequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/propriedadeequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_create',  '_route' => 'admin_app_propriedadeequipamento_create',);
                }

                // admin_app_propriedadeequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/propriedadeequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_batch',  '_route' => 'admin_app_propriedadeequipamento_batch',);
                }

                // admin_app_propriedadeequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/propriedadeequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_export',  '_route' => 'admin_app_propriedadeequipamento_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_propriedadeequipamento_edit
                if (preg_match('#^/app/propriedadeequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_propriedadeequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_edit',));
                }

                // admin_app_propriedadeequipamento_delete
                if (preg_match('#^/app/propriedadeequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_propriedadeequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_delete',));
                }

                // admin_app_propriedadeequipamento_show
                if (preg_match('#^/app/propriedadeequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_propriedadeequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_show',));
                }

                // admin_app_propriedadeequipamento_acl
                if (preg_match('#^/app/propriedadeequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_propriedadeequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.propriedade_equipamento',  '_sonata_name' => 'admin_app_propriedadeequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/tituloagendamentomanutencaoequipamento')) {
                // admin_app_tituloagendamentomanutencaoequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/tituloagendamentomanutencaoequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_list',  '_route' => 'admin_app_tituloagendamentomanutencaoequipamento_list',);
                }

                // admin_app_tituloagendamentomanutencaoequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/tituloagendamentomanutencaoequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_create',  '_route' => 'admin_app_tituloagendamentomanutencaoequipamento_create',);
                }

                // admin_app_tituloagendamentomanutencaoequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/tituloagendamentomanutencaoequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_batch',  '_route' => 'admin_app_tituloagendamentomanutencaoequipamento_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_tituloagendamentomanutencaoequipamento_edit
                if (preg_match('#^/app/tituloagendamentomanutencaoequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tituloagendamentomanutencaoequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_edit',));
                }

                // admin_app_tituloagendamentomanutencaoequipamento_delete
                if (preg_match('#^/app/tituloagendamentomanutencaoequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tituloagendamentomanutencaoequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_delete',));
                }

                // admin_app_tituloagendamentomanutencaoequipamento_show
                if (preg_match('#^/app/tituloagendamentomanutencaoequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tituloagendamentomanutencaoequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_show',));
                }

                // admin_app_tituloagendamentomanutencaoequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/tituloagendamentomanutencaoequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_export',  '_route' => 'admin_app_tituloagendamentomanutencaoequipamento_export',);
                }

                // admin_app_tituloagendamentomanutencaoequipamento_acl
                if (preg_match('#^/app/tituloagendamentomanutencaoequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_tituloagendamentomanutencaoequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.titulo_agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_tituloagendamentomanutencaoequipamento_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/agendamentomanutencaoequipamento')) {
                // admin_app_agendamentomanutencaoequipamento_list
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentomanutencaoequipamento/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_list',  '_route' => 'admin_app_agendamentomanutencaoequipamento_list',);
                }

                // admin_app_agendamentomanutencaoequipamento_create
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentomanutencaoequipamento/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_create',  '_route' => 'admin_app_agendamentomanutencaoequipamento_create',);
                }

                // admin_app_agendamentomanutencaoequipamento_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentomanutencaoequipamento/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_batch',  '_route' => 'admin_app_agendamentomanutencaoequipamento_batch',);
                }

                $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                // admin_app_agendamentomanutencaoequipamento_edit
                if (preg_match('#^/app/agendamentomanutencaoequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentomanutencaoequipamento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_edit',));
                }

                // admin_app_agendamentomanutencaoequipamento_delete
                if (preg_match('#^/app/agendamentomanutencaoequipamento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentomanutencaoequipamento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_delete',));
                }

                // admin_app_agendamentomanutencaoequipamento_show
                if (preg_match('#^/app/agendamentomanutencaoequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentomanutencaoequipamento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_show',));
                }

                // admin_app_agendamentomanutencaoequipamento_export
                if ($pathinfo === '/app/'.$perfilLogado.'/agendamentomanutencaoequipamento/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_export',  '_route' => 'admin_app_agendamentomanutencaoequipamento_export',);
                }

                // admin_app_agendamentomanutencaoequipamento_acl
                if (preg_match('#^/app/agendamentomanutencaoequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_agendamentomanutencaoequipamento_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.agendamento_manutencao_equipamento',  '_sonata_name' => 'admin_app_agendamentomanutencaoequipamento_acl',));
                }

            }

           if($pathinfo == '/app/execucaodeprocedimentoequipamento/listprocedimentos') {

               $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

               // admin_app_execucaodeprocedimentoequipamento_listprocedimentos
               if ($pathinfo === '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento/listprocedimentos') {
                   return array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::listprocedimentosAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_listprocedimentos', '_route' => 'admin_app_execucaodeprocedimentoequipamento_listprocedimentos',);
               }
           }


             if (0 === strpos($pathinfo, '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento')) {

                 // admin_app_execucaodeprocedimentoequipamento_list
                 if ($pathinfo === '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento/list') {
                     return array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::listAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_list', '_route' => 'admin_app_execucaodeprocedimentoequipamento_list',);
                 }

                 // admin_app_execucaodeprocedimentoequipamento_create
                 if ($pathinfo === '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento/create') {
                     return array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::createAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_create', '_route' => 'admin_app_execucaodeprocedimentoequipamento_create',);
                 }

                 // admin_app_execucaodeprocedimentoequipamento_batch
                 if ($pathinfo === '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento/batch') {
                     return array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::batchAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_batch', '_route' => 'admin_app_execucaodeprocedimentoequipamento_batch',);
                 }


                 // admin_app_execucaodeprocedimentoequipamento_export
                 if ($pathinfo === '/app/'.$perfilLogado .'/execucaodeprocedimentoequipamento/export') {
                     return array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::exportAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_export', '_route' => 'admin_app_execucaodeprocedimentoequipamento_export',);
                 }

                 $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                 // admin_app_execucaodeprocedimentoequipamento_edit
                 if (preg_match('#^/app/execucaodeprocedimentoequipamento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                     return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_execucaodeprocedimentoequipamento_edit')), array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::editAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_edit',));
                 }

                 // admin_app_execucaodeprocedimentoequipamento_show
                 if (preg_match('#^/app/execucaodeprocedimentoequipamento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                     return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_execucaodeprocedimentoequipamento_show')), array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::showAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_show',));
                 }


                 // admin_app_execucaodeprocedimentoequipamento_acl
                 if (preg_match('#^/app/execucaodeprocedimentoequipamento/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                     return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_execucaodeprocedimentoequipamento_acl')), array('_controller' => 'AppBundle\\Controller\\ExecucaoDeProcedimentosEquipamentoCRUDController::aclAction', '_sonata_admin' => 'app.admin.execucao_de_procedimento_equipamento', '_sonata_name' => 'admin_app_execucaodeprocedimentoequipamento_acl',));
                 }


             }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/clienteequipamentolog')) {
                // admin_app_clienteequipamentolog_list
                if ($pathinfo === '/app/'.$perfilLogado.'/clienteequipamentolog/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.cliente_equipamento_log',  '_sonata_name' => 'admin_app_clienteequipamentolog_list',  '_route' => 'admin_app_clienteequipamentolog_list',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_clienteequipamentolog_show
                if (preg_match('#^/app/clienteequipamentolog/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clienteequipamentolog_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.cliente_equipamento_log',  '_sonata_name' => 'admin_app_clienteequipamentolog_show',));
                }
            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/norma')) {
                // admin_app_norma_list
                if ($pathinfo === '/app/'.$perfilLogado.'/norma/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_list',  '_route' => 'admin_app_norma_list',);
                }

                // admin_app_norma_create
                if ($pathinfo === '/app/'.$perfilLogado.'/norma/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_create',  '_route' => 'admin_app_norma_create',);
                }

                // admin_app_norma_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/norma/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_batch',  '_route' => 'admin_app_norma_batch',);
                }

                // admin_app_norma_export
                if ($pathinfo === '/app/'.$perfilLogado.'/norma/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_export',  '_route' => 'admin_app_norma_export',);
                }


                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_norma_edit
                if (preg_match('#^/app/norma/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_norma_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_edit',));
                }

                // admin_app_norma_delete
                if (preg_match('#^/app/norma/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_norma_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_delete',));
                }

                // admin_app_norma_show
                if (preg_match('#^/app/norma/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_norma_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_show',));
                }


                // admin_app_norma_acl
                if (preg_match('#^/app/norma/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_norma_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.norma',  '_sonata_name' => 'admin_app_norma_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/fichatecnicaproduto')) {
                // admin_app_fichatecnicaproduto_list
                if ($pathinfo === '/app/'.$perfilLogado.'/fichatecnicaproduto/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_list',  '_route' => 'admin_app_fichatecnicaproduto_list',);
                }

                // admin_app_fichatecnicaproduto_create
                if ($pathinfo === '/app/'.$perfilLogado.'/fichatecnicaproduto/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_create',  '_route' => 'admin_app_fichatecnicaproduto_create',);
                }

                // admin_app_fichatecnicaproduto_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/fichatecnicaproduto/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_batch',  '_route' => 'admin_app_fichatecnicaproduto_batch',);
                }

                // admin_app_fichatecnicaproduto_export
                if ($pathinfo === '/app/'.$perfilLogado.'/fichatecnicaproduto/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_export',  '_route' => 'admin_app_fichatecnicaproduto_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_fichatecnicaproduto_edit
                if (preg_match('#^/app/fichatecnicaproduto/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fichatecnicaproduto_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_edit',));
                }

                // admin_app_fichatecnicaproduto_delete
                if (preg_match('#^/app/fichatecnicaproduto/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fichatecnicaproduto_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_delete',));
                }

                // admin_app_fichatecnicaproduto_show
                if (preg_match('#^/app/fichatecnicaproduto/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fichatecnicaproduto_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_show',));
                }

                // admin_app_fichatecnicaproduto_acl
                if (preg_match('#^/app/fichatecnicaproduto/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fichatecnicaproduto_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.ficha_tecnica_produto',  '_sonata_name' => 'admin_app_fichatecnicaproduto_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/app/'.$perfilLogado.'/localizacao')) {
                // admin_app_localizacao_list
                if ($pathinfo === '/app/'.$perfilLogado.'/localizacao/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_list',  '_route' => 'admin_app_localizacao_list',);
                }

                // admin_app_localizacao_create
                if ($pathinfo === '/app/'.$perfilLogado.'/localizacao/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_create',  '_route' => 'admin_app_localizacao_create',);
                }

                // admin_app_localizacao_batch
                if ($pathinfo === '/app/'.$perfilLogado.'/localizacao/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_batch',  '_route' => 'admin_app_localizacao_batch',);
                }

                // admin_app_localizacao_export
                if ($pathinfo === '/app/'.$perfilLogado.'/localizacao/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_export',  '_route' => 'admin_app_localizacao_export',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_app_localizacao_edit
                if (preg_match('#^/app/localizacao/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_localizacao_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_edit',));
                }

                // admin_app_localizacao_delete
                if (preg_match('#^/app/localizacao/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_localizacao_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_delete',));
                }

                // admin_app_localizacao_show
                if (preg_match('#^/app/localizacao/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_localizacao_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_show',));
                }

                // admin_app_localizacao_acl
                if (preg_match('#^/app/localizacao/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_localizacao_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'app.admin.localizacao',  '_sonata_name' => 'admin_app_localizacao_acl',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/'.$perfilLogado.'/user')) {
            // app_user_list
            if ($pathinfo === '/'.$perfilLogado.'/user/list') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_list',  '_route' => 'app_user_list',);
            }

            // app_user_create
            if ($pathinfo === '/'.$perfilLogado.'/user/create') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_create',  '_route' => 'app_user_create',);
            }

            // app_user_batch
            if ($pathinfo === '/'.$perfilLogado.'/user/batch') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_batch',  '_route' => 'app_user_batch',);
            }

            $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

            // app_user_edit
            if (preg_match('#^/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_edit',));
            }

            // app_user_delete
            if (preg_match('#^/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_delete',));
            }

            // app_user_show
            if (preg_match('#^/user/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_show',));
            }

            // app_user_export
            if ($pathinfo === '/'.$perfilLogado.'/user/export') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_export',  '_route' => 'app_user_export',);
            }

            // app_user_acl
            if (preg_match('#^/user/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'app_user_acl',));
            }

        }

        if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata')) {
            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/user/group')) {
                // admin_sonata_user_group_list
                if ($pathinfo === '/'.$perfilLogado.'/sonata/user/group/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_list',  '_route' => 'admin_sonata_user_group_list',);
                }

                // admin_sonata_user_group_create
                if ($pathinfo === '/'.$perfilLogado.'/sonata/user/group/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_create',  '_route' => 'admin_sonata_user_group_create',);
                }

                // admin_sonata_user_group_batch
                if ($pathinfo === '/'.$perfilLogado.'/sonata/user/group/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_batch',  '_route' => 'admin_sonata_user_group_batch',);
                }

                $pathinfo = str_replace($perfilLogado.'/', '', $pathinfo);

                // admin_sonata_user_group_edit
                if (preg_match('#^/sonata/user/group/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_edit',));
                }

                // admin_sonata_user_group_delete
                if (preg_match('#^/sonata/user/group/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_delete',));
                }

                // admin_sonata_user_group_show
                if (preg_match('#^/sonata/user/group/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_show',));
                }

                // admin_sonata_user_group_export
                if ($pathinfo === '/'.$perfilLogado.'/sonata/user/group/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_export',  '_route' => 'admin_sonata_user_group_export',);
                }

                // admin_sonata_user_group_acl
                if (preg_match('#^/sonata/user/group/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_acl',));
                }

            }

            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/media')) {
                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/media/media')) {
                    // admin_sonata_media_media_list
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/media/list') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_list',  '_route' => 'admin_sonata_media_media_list',);
                    }

                    // admin_sonata_media_media_create
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/media/create') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_create',  '_route' => 'admin_sonata_media_media_create',);
                    }

                    // admin_sonata_media_media_batch
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/media/batch') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_batch',  '_route' => 'admin_sonata_media_media_batch',);
                    }

                    $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                    // admin_sonata_media_media_edit
                    if (preg_match('#^/sonata/media/media/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_edit',));
                    }

                    // admin_sonata_media_media_delete
                    if (preg_match('#^/sonata/media/media/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_delete',));
                    }

                    // admin_sonata_media_media_show
                    if (preg_match('#^/sonata/media/media/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_show',));
                    }

                    // admin_sonata_media_media_export
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/media/export') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_export',  '_route' => 'admin_sonata_media_media_export',);
                    }

                    // admin_sonata_media_media_acl
                    if (preg_match('#^/sonata/media/media/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_acl')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::aclAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/media/gallery')) {
                    // admin_sonata_media_gallery_list
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/gallery/list') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_list',  '_route' => 'admin_sonata_media_gallery_list',);
                    }

                    // admin_sonata_media_gallery_create
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/gallery/create') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_create',  '_route' => 'admin_sonata_media_gallery_create',);
                    }

                    // admin_sonata_media_gallery_batch
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/gallery/batch') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_batch',  '_route' => 'admin_sonata_media_gallery_batch',);
                    }

                    $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                    // admin_sonata_media_gallery_edit
                    if (preg_match('#^/sonata/media/gallery/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_edit',));
                    }

                    // admin_sonata_media_gallery_delete
                    if (preg_match('#^/sonata/media/gallery/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_delete',));
                    }

                    // admin_sonata_media_gallery_show
                    if (preg_match('#^/sonata/media/gallery/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_show',));
                    }

                    // admin_sonata_media_gallery_export
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/media/gallery/export') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_export',  '_route' => 'admin_sonata_media_gallery_export',);
                    }

                    // admin_sonata_media_gallery_acl
                    if (preg_match('#^/sonata/media/gallery/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_acl')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::aclAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_acl',));
                    }

                    if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/media/galleryhasmedia')) {
                        // admin_sonata_media_galleryhasmedia_list
                        if ($pathinfo === '/'.$perfilLogado.'sonata/media/galleryhasmedia/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_list',  '_route' => 'admin_sonata_media_galleryhasmedia_list',);
                        }

                        // admin_sonata_media_galleryhasmedia_create
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/media/galleryhasmedia/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_create',  '_route' => 'admin_sonata_media_galleryhasmedia_create',);
                        }

                        // admin_sonata_media_galleryhasmedia_batch
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/media/galleryhasmedia/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_batch',  '_route' => 'admin_sonata_media_galleryhasmedia_batch',);
                        }

                        $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                        // admin_sonata_media_galleryhasmedia_edit
                        if (preg_match('#^/sonata/media/galleryhasmedia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_edit',));
                        }

                        // admin_sonata_media_galleryhasmedia_delete
                        if (preg_match('#^/sonata/media/galleryhasmedia/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_delete',));
                        }

                        // admin_sonata_media_galleryhasmedia_show
                        if (preg_match('#^/sonata/media/galleryhasmedia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_show',));
                        }

                        // admin_sonata_media_galleryhasmedia_export
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/media/galleryhasmedia/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_export',  '_route' => 'admin_sonata_media_galleryhasmedia_export',);
                        }

                        // admin_sonata_media_galleryhasmedia_acl
                        if (preg_match('#^/sonata/media/galleryhasmedia/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_acl',));
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification')) {
                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification/category')) {
                    // admin_sonata_classification_category_list
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/category/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_list',  '_route' => 'admin_sonata_classification_category_list',);
                    }

                    // admin_sonata_classification_category_create
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/category/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_create',  '_route' => 'admin_sonata_classification_category_create',);
                    }

                    // admin_sonata_classification_category_batch
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/category/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_batch',  '_route' => 'admin_sonata_classification_category_batch',);
                    }

                    $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                    // admin_sonata_classification_category_edit
                    if (preg_match('#^/sonata/classification/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_edit',));
                    }

                    // admin_sonata_classification_category_delete
                    if (preg_match('#^/sonata/classification/category/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_delete',));
                    }

                    // admin_sonata_classification_category_show
                    if (preg_match('#^/sonata/classification/category/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_show',));
                    }

                    // admin_sonata_classification_category_export
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/category/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_export',  '_route' => 'admin_sonata_classification_category_export',);
                    }

                    // admin_sonata_classification_category_acl
                    if (preg_match('#^/sonata/classification/category/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_acl',));
                    }

                    // admin_sonata_classification_category_tree
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/category/tree') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::treeAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_tree',  '_route' => 'admin_sonata_classification_category_tree',);
                    }

                }

                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification/tag')) {
                    // admin_sonata_classification_tag_list
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/tag/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_list',  '_route' => 'admin_sonata_classification_tag_list',);
                    }

                    // admin_sonata_classification_tag_create
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/tag/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_create',  '_route' => 'admin_sonata_classification_tag_create',);
                    }

                    // admin_sonata_classification_tag_batch
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/tag/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_batch',  '_route' => 'admin_sonata_classification_tag_batch',);
                    }

                    $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                    // admin_sonata_classification_tag_edit
                    if (preg_match('#^/sonata/classification/tag/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_edit',));
                    }

                    // admin_sonata_classification_tag_delete
                    if (preg_match('#^/sonata/classification/tag/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_delete',));
                    }

                    // admin_sonata_classification_tag_show
                    if (preg_match('#^/sonata/classification/tag/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_show',));
                    }

                    // admin_sonata_classification_tag_export
                    if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/tag/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_export',  '_route' => 'admin_sonata_classification_tag_export',);
                    }

                    // admin_sonata_classification_tag_acl
                    if (preg_match('#^/sonata/classification/tag/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_acl',));
                    }

                }

                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification/co')) {
                    if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification/collection')) {
                        // admin_sonata_classification_collection_list
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/collection/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_list',  '_route' => 'admin_sonata_classification_collection_list',);
                        }

                        // admin_sonata_classification_collection_create
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/collection/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_create',  '_route' => 'admin_sonata_classification_collection_create',);
                        }

                        // admin_sonata_classification_collection_batch
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/collection/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_batch',  '_route' => 'admin_sonata_classification_collection_batch',);
                        }

                        $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                        // admin_sonata_classification_collection_edit
                        if (preg_match('#^/sonata/classification/collection/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_edit',));
                        }

                        // admin_sonata_classification_collection_delete
                        if (preg_match('#^/sonata/classification/collection/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_delete',));
                        }

                        // admin_sonata_classification_collection_show
                        if (preg_match('#^/sonata/classification/collection/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_show',));
                        }

                        // admin_sonata_classification_collection_export
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/collection/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_export',  '_route' => 'admin_sonata_classification_collection_export',);
                        }

                        // admin_sonata_classification_collection_acl
                        if (preg_match('#^/sonata/classification/collection/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_acl',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/'.$perfilLogado.'/sonata/classification/context')) {
                        // admin_sonata_classification_context_list
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/context/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_list',  '_route' => 'admin_sonata_classification_context_list',);
                        }

                        // admin_sonata_classification_context_create
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/context/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_create',  '_route' => 'admin_sonata_classification_context_create',);
                        }

                        // admin_sonata_classification_context_batch
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/context/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_batch',  '_route' => 'admin_sonata_classification_context_batch',);
                        }

                        $pathinfo= substr($pathinfo, 0,5).substr($pathinfo, 14);

                        // admin_sonata_classification_context_edit
                        if (preg_match('#^/sonata/classification/context/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_context_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_edit',));
                        }

                        // admin_sonata_classification_context_delete
                        if (preg_match('#^/sonata/classification/context/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_context_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_delete',));
                        }

                        // admin_sonata_classification_context_show
                        if (preg_match('#^/sonata/classification/context/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_context_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_show',));
                        }

                        // admin_sonata_classification_context_export
                        if ($pathinfo === '/'.$perfilLogado.'/sonata/classification/context/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_export',  '_route' => 'admin_sonata_classification_context_export',);
                        }

                        // admin_sonata_classification_context_acl
                        if (preg_match('#^/sonata/classification/context/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_context_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.context',  '_sonata_name' => 'admin_sonata_classification_context_acl',));
                        }

                    }

                }

            }

        }




        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // sonata_user_admin_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::loginAction',  '_route' => 'sonata_user_admin_security_login',);
                }

                // sonata_user_admin_security_check
                if ($pathinfo === '/login_check') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::checkAction',  '_route' => 'sonata_user_admin_security_check',);
                }

            }

            // sonata_user_admin_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::logoutAction',  '_route' => 'sonata_user_admin_security_logout',);
            }

            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

            if (0 === strpos($pathinfo, '/login')) {
                // sonata_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'sonata_user_security_login',);
                }

                // sonata_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_sonata_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'sonata_user_security_check',);
                }
                not_sonata_user_security_check:

            }

            // sonata_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'sonata_user_security_logout',);
            }

        }




        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            if (0 === strpos($pathinfo, '/resetting/re')) {
                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
                }
                not_fos_user_resetting_reset:

                // sonata_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_resetting_request;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'sonata_user_resetting_request',);
                }
                not_sonata_user_resetting_request:

            }

            // sonata_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_sonata_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'sonata_user_resetting_send_email',);
            }
            not_sonata_user_resetting_send_email:

            // sonata_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_resetting_check_email',);
            }
            not_sonata_user_resetting_check_email:

            // sonata_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
            }
            not_sonata_user_resetting_reset:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // fos_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'fos_user_profile_edit_authentication',);
                }

                // fos_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'fos_user_profile_edit',);
                }

            }

            // sonata_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_profile_show');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'sonata_user_profile_show',);
            }
            not_sonata_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // sonata_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'sonata_user_profile_edit_authentication',);
                }

                // sonata_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'sonata_user_profile_edit',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // fos_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm/')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            // sonata_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'sonata_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // sonata_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_registration_check_email',);
                }
                not_sonata_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // sonata_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_sonata_user_registration_confirm:

                    // sonata_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'sonata_user_registration_confirmed',);
                    }
                    not_sonata_user_registration_confirmed:

                }

            }

        }

        if (0 === strpos($pathinfo, '/profile/change-password')) {
            // fos_user_change_password
            if ($pathinfo === '/profile/change-password') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_change_password;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'fos_user_change_password',);
            }
            not_fos_user_change_password:

            // sonata_user_change_password
            if ($pathinfo === '/profile/change-password') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_change_password;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'sonata_user_change_password',);
            }
            not_sonata_user_change_password:

        }

        if (0 === strpos($pathinfo, '/media/cache/resolve')) {
            // liip_imagine_filter_runtime
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/rc/(?P<hash>[^/]++)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter_runtime;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter_runtime')), array (  '_controller' => 'liip_imagine.controller:filterRuntimeAction',));
            }
            not_liip_imagine_filter_runtime:

            // liip_imagine_filter
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter')), array (  '_controller' => 'liip_imagine.controller:filterAction',));
            }
            not_liip_imagine_filter:

        }

        ////////////////////////////////// ENDEREÇOS USADOS PELO APLICATIVO ////////////////////////////////////////////
        if (0 === strpos($pathinfo, '/api/v1')) {
            // api_1_get_user
            if (0 === strpos($pathinfo, '/api/v1/users/login') && preg_match('#^/api/v1/users/login(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_1_get_user;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_get_user')), array (  '_controller' => 'AppBundle\\Controller\\APISecurityController::getUserAction',  '_format' => NULL,));
            }
            not_api_1_get_user:

            if (0 === strpos($pathinfo, '/api/v1/os')) {
                // api_1_get_os
                if (preg_match('#^/api/v1/os(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_1_get_os;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_get_os')), array (  '_controller' => 'AppBundle\\Controller\\APIOsController::getOsAction',  '_format' => NULL,));
                }
                not_api_1_get_os:

                // api_1_post_os_foto
                if (preg_match('#^/api/v1/os/(?P<os>[^/]++)/fotos(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_1_post_os_foto;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_os_foto')), array (  '_controller' => 'AppBundle\\Controller\\APIOsController::postOsFotoAction',  '_format' => NULL,));
                }
                not_api_1_post_os_foto:

                // api_1_post_os_realizada
                if (preg_match('#^/api/v1/os/(?P<os>[^/]++)/realizadas(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_1_post_os_realizada;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_os_realizada')), array (  '_controller' => 'AppBundle\\Controller\\APIOsController::postOsRealizadaAction',  '_format' => NULL,));
                }
                not_api_1_post_os_realizada:

                // api_1_post_os_pmoc_realizada
                if (preg_match('#^/api/v1/os/(?P<os>[^/]++)/pmocs/realizadas(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_1_post_os_pmoc_realizada;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_os_pmoc_realizada')), array (  '_controller' => 'AppBundle\\Controller\\APIOsController::postOsPmocRealizadaAction',  '_format' => NULL,));
                }
                not_api_1_post_os_pmoc_realizada:

            }

            // api_1_post_foto_execucao_os
            if (0 === strpos($pathinfo, '/api/v1/fotos') && preg_match('#^/api/v1/fotos/(?P<execucao>[^/]++)/execucaos/os(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_1_post_foto_execucao_os;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_foto_execucao_os')), array (  '_controller' => 'AppBundle\\Controller\\APIOsController::postFotoExecucaoOsAction',  '_format' => NULL,));
            }
            not_api_1_post_foto_execucao_os:

            // api_1_post_array_tempo_ocioso_tecnico
            if (0 === strpos($pathinfo, '/api/v1/arrays/tempos/ociosos/tecnicos') && preg_match('#^/api/v1/arrays/tempos/ociosos/tecnicos(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_1_post_array_tempo_ocioso_tecnico;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_array_tempo_ocioso_tecnico')), array (  '_controller' => 'AppBundle\\Controller\\APITecnicoController::postArrayTempoOciosoTecnicoAction',  '_format' => NULL,));
            }
            not_api_1_post_array_tempo_ocioso_tecnico:

            // api_1_post_tempo_ocioso_tecnico
            if (0 === strpos($pathinfo, '/api/v1/tempos/ociosos/tecnicos') && preg_match('#^/api/v1/tempos/ociosos/tecnicos(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_1_post_tempo_ocioso_tecnico;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_tempo_ocioso_tecnico')), array (  '_controller' => 'AppBundle\\Controller\\APITecnicoController::postTempoOciosoTecnicoAction',  '_format' => NULL,));
            }
            not_api_1_post_tempo_ocioso_tecnico:

            // api_1_post_location_tecnico
            if (0 === strpos($pathinfo, '/api/v1/locations/tecnicos') && preg_match('#^/api/v1/locations/tecnicos(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_1_post_location_tecnico;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_post_location_tecnico')), array (  '_controller' => 'AppBundle\\Controller\\APITecnicoController::postLocationTecnicoAction',  '_format' => NULL,));
            }
            not_api_1_post_location_tecnico:

        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // app_apisecurity_getuser
        if ($pathinfo === '/users/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_app_apisecurity_getuser;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\APISecurityController::getUserAction',  '_route' => 'app_apisecurity_getuser',);
        }
        not_app_apisecurity_getuser:

        if (0 === strpos($pathinfo, '/ajax')) {
            // create_homologacao_os
            if ($pathinfo === '/ajax/create-homologacao-os') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_create_homologacao_os;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::createHomologacaoOs',  '_route' => 'create_homologacao_os',);
            }
            not_create_homologacao_os:

            if (0 === strpos($pathinfo, '/ajax/reagenda-execucoes-procedimentos')) {
                // reagenda_execucoes_procedimentos_cliente
                if ($pathinfo === '/ajax/reagenda-execucoes-procedimentos-cliente') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_reagenda_execucoes_procedimentos_cliente;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::reagendaExecucoesProcedimentosCliente',  '_route' => 'reagenda_execucoes_procedimentos_cliente',);
                }
                not_reagenda_execucoes_procedimentos_cliente:

                // reagenda_execucoes_procedimentos
                if ($pathinfo === '/ajax/reagenda-execucoes-procedimentos') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_reagenda_execucoes_procedimentos;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::reagendaExecucoesProcedimentos',  '_route' => 'reagenda_execucoes_procedimentos',);
                }
                not_reagenda_execucoes_procedimentos:

            }

            if (0 === strpos($pathinfo, '/ajax/get-')) {
                // get_procedimentos_equipamento
                if ($pathinfo === '/ajax/get-procedimentos-equipamento') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_procedimentos_equipamento;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::getProcedimentosEquipamento',  '_route' => 'get_procedimentos_equipamento',);
                }
                not_get_procedimentos_equipamento:

                // get_enderecos_cliente
                if ($pathinfo === '/ajax/get-enderecos-cliente') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_get_enderecos_cliente;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::getEnderecosDeCliente',  '_route' => 'get_enderecos_cliente',);
                }
                not_get_enderecos_cliente:

                // get_ambiente_cliente
                if ($pathinfo === '/ajax/get-ambiente-cliente') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_get_enderecos_cliente;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::getAmbienteCliente',  '_route' => 'get_enderecos_cliente',);
                }
                not_get_ambiente_cliente:


                // get_procedimentos
                if ($pathinfo === '/ajax/get-procedimentos') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_get_enderecos_cliente;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::getProcedimentos',  '_route' => 'get_procedimentos',);
                }
                not_get_procedimentos:

            }

            if (0 === strpos($pathinfo, '/ajax/c')) {
                // create_os_by_procedimento_agendado
                if ($pathinfo === '/ajax/create-os-by-procedimento-agendado') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_create_os_by_procedimento_agendado;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::createOsByProcedimentoAgendado',  '_route' => 'create_os_by_procedimento_agendado',);
                }
                not_create_os_by_procedimento_agendado:

                if (0 === strpos($pathinfo, '/ajax/change-status-')) {
                    // change_status_compra
                    if ($pathinfo === '/ajax/change-status-compra') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_change_status_compra;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::changeStatusCompraAction',  '_route' => 'change_status_compra',);
                    }
                    not_change_status_compra:

                    // change_status_orcamento
                    if ($pathinfo === '/ajax/change-status-orcamento') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_change_status_orcamento;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::changeStatusOrcamentoAction',  '_route' => 'change_status_orcamento',);
                    }
                    not_change_status_orcamento:

                }

            }

            if ($pathinfo === '/ajax/isRegistred') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_isRegistred;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::isRegistred',  '_route' => 'isRegistred',);
            }
            not_isRegistred:

        }

        // nelmio_api_doc_index
        if (0 === strpos($pathinfo, '/doc/api') && preg_match('#^/doc/api(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_nelmio_api_doc_index;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
        }
        not_nelmio_api_doc_index:

        if (0 === strpos($pathinfo, '/shtumi_')) {
            // shtumi_ajaxautocomplete
            if ($pathinfo === '/shtumi_ajaxautocomplete') {
                return array (  '_controller' => 'Shtumi\\UsefulBundle\\Controller\\AjaxAutocompleteJSONController::getJSONAction',  '_route' => 'shtumi_ajaxautocomplete',);
            }

            // shtumi_select2_entity
            if ($pathinfo === '/shtumi_select2_entity') {
                return array (  '_controller' => 'Shtumi\\UsefulBundle\\Controller\\Select2EntityController::getJSONAction',  '_route' => 'shtumi_select2_entity',);
            }

            // shtumi_ajaxfileupload
            if ($pathinfo === '/shtumi_ajaxfileupload') {
                return array (  '_controller' => 'Shtumi\\UsefulBundle\\Controller\\AjaxFileController::uploadAction',  '_route' => 'shtumi_ajaxfileupload',);
            }

            if (0 === strpos($pathinfo, '/shtumi_dependent_filtered_')) {
                // shtumi_dependent_filtered_entity
                if ($pathinfo === '/shtumi_dependent_filtered_entity') {
                    return array (  '_controller' => 'ShtumiUsefulBundle:DependentFilteredEntity:getOptions',  '_route' => 'shtumi_dependent_filtered_entity',);
                }

                // shtumi_dependent_filtered_select2
                if ($pathinfo === '/shtumi_dependent_filtered_select2') {
                    return array (  '_controller' => 'Shtumi\\UsefulBundle\\Controller\\DependentFilteredEntityController::getJsonAction',  '_route' => 'shtumi_dependent_filtered_select2',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/'.$perfilLogado.'/media')) {
            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/media/gallery')) {
                // sonata_media_gallery_index
                if (rtrim($pathinfo, '/') === '/'.$perfilLogado.'/media/gallery') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_media_gallery_index');
                    }

                    return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::indexAction',  '_route' => 'sonata_media_gallery_index',);
                }

                // sonata_media_gallery_view
                if (0 === strpos($pathinfo, '/'.$perfilLogado.'/media/gallery/view') && preg_match('#^/media/gallery/view/(?P<id>.*)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_gallery_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::viewAction',));
                }

            }

            // sonata_media_view
            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/media/view') && preg_match('#^/media/view/(?P<id>[^/]++)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::viewAction',  'format' => 'reference',));
            }

            // sonata_media_download
            if (0 === strpos($pathinfo, '/'.$perfilLogado.'/media/download') && preg_match('#^/media/download/(?P<id>.*)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_download')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::downloadAction',  'format' => 'reference',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
