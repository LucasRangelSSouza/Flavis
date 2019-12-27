<?php

/* SonataUserBundle:Admin:Security/login.html.twig */
class __TwigTemplate_a7944019f098491f3b7db357c0ced3738762f3340e1c1cf9d41267a1e4f0adfb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'logo' => array($this, 'block_logo'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'body_attributes' => array($this, 'block_body_attributes'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
            'sonata_user_login_form' => array($this, 'block_sonata_user_login_form'),
            'sonata_user_login_error' => array($this, 'block_sonata_user_login_error'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : null), "SonataUserBundle:Admin:Security/login.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_sonata_nav($context, array $blocks = array())
    {
    }

    // line 6
    public function block_logo($context, array $blocks = array())
    {
    }

    // line 9
    public function block_sonata_left_side($context, array $blocks = array())
    {
    }

    // line 12
    public function block_body_attributes($context, array $blocks = array())
    {
        echo "class=\"sonata-bc login-page\"";
    }

    // line 14
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        // line 15
        echo "    <style>
        body{
            background: #111 !important;
        }
    </style>

    <div class=\"login-box\">
        <div class=\"login-logo\">
            <a href=\"";
        // line 23
        echo $this->env->getExtension('routing')->getPath("sonata_admin_dashboard");
        echo "\">
                ";
        // line 24
        if ((("single_text" != $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getOption", array(0 => "title_mode"), "method")) || ("both" == $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getOption", array(0 => "title_mode"), "method")))) {
            // line 25
            echo "                    <span style=\"color: #fff;font-family: 'Special Elite', cursive;display:block;padding-bottom:15px;text-align:center;\">
                        <img src=\"/bundles/app/img/logo_app.png\" style=\"height: 70px;display:block;margin:auto;\"></span>
                ";
        }
        // line 28
        echo "            </a>
        </div>
        <div class=\"login-box-body\">
            ";
        // line 31
        $this->displayBlock('sonata_user_login_form', $context, $blocks);
        // line 69
        echo "        </div>
    </div>

";
    }

    // line 31
    public function block_sonata_user_login_form($context, array $blocks = array())
    {
        // line 32
        echo "                ";
        $this->displayBlock('sonata_user_login_error', $context, $blocks);
        // line 37
        echo "                <p class=\"login-box-msg\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_authentication", array(), "SonataUserBundle"), "html", null, true);
        echo "</p>
                <form action=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("sonata_user_admin_security_check");
        echo "\" method=\"post\" role=\"form\">
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 39
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : null), "html", null, true);
        echo "\"/>

                    <div class=\"form-group has-feedback\">
                        <input type=\"text\" class=\"form-control\" id=\"username\"  name=\"_username\" value=\"";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : null), "html", null, true);
        echo "\" required=\"required\" placeholder=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "SonataUserBundle"), "html", null, true);
        echo "\"/>
                        <span class=\"glyphicon glyphicon-user form-control-feedback\"></span>
                    </div>

                    <div class=\"form-group has-feedback\">
                        <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" required=\"required\" placeholder=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "SonataUserBundle"), "html", null, true);
        echo "\"/>
                        <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-xs-8\">
                            <div class=\"checkbox icheck\">
                                <label>
                                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"/>
                                    ";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                                </label>
                            </div>
                        </div>
                        <div class=\"col-xs-4\">
                            <button type=\"submit\" class=\"btn btn-primary btn-block btn-flat\">";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button>
                        </div>
                    </div>
                </form>

                ";
        // line 67
        echo "                ";
        // line 68
        echo "            ";
    }

    // line 32
    public function block_sonata_user_login_error($context, array $blocks = array())
    {
        // line 33
        echo "                    ";
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 34
            echo "                        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["error"]) ? $context["error"] : null), array(), "FOSUserBundle"), "html", null, true);
            echo "</div>
                    ";
        }
        // line 36
        echo "                ";
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Admin:Security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 36,  163 => 34,  160 => 33,  157 => 32,  153 => 68,  151 => 67,  143 => 61,  135 => 56,  123 => 47,  113 => 42,  107 => 39,  103 => 38,  98 => 37,  95 => 32,  92 => 31,  85 => 69,  83 => 31,  78 => 28,  73 => 25,  71 => 24,  67 => 23,  57 => 15,  54 => 14,  48 => 12,  43 => 9,  38 => 6,  33 => 3,  24 => 1,);
    }
}
