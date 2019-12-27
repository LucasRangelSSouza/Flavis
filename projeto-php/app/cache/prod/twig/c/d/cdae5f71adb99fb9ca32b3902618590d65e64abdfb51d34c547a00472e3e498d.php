<?php

/* FOSUserBundle:Resetting:reset_content.html.twig */
class __TwigTemplate_cdae5f71adb99fb9ca32b3902618590d65e64abdfb51d34c547a00472e3e498d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        echo "<style>
label{
float: left;
font-family: 'Roboto Slab', serif;
margin-right: 15px;
margin-bottom: 15px;
}

#fos_user_resetting_form_new_first{
float: right;
margin-bottom: 15px;
border-radius: 7px;
outline: none;
}

#fos_user_resetting_form_new_second{
border-radius: 7px;
outline: none;
}



.card-form {
  margin-top: 5%;
  width: 40%;
  border-radius: 10px;
  background: white;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

.form-title, .button{
  color:white;
font-family: 'Roboto Slab', serif;
}

.card-form .form-title {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 80px;
  font-size: 20px;
  font-weight: bold;
  background: rgb(255, 140, 52);
  border-radius: 10px 10px 0 0;
}
.card-form .form-body {
  padding: 10px;
}
.card-form .form-body .row {
  display: flex;
  justify-content: space-around;
  padding: 35px;
}
.card-form .form-body .row input[type=\"text\"] {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: none;
  border: none;
  font-size: 14px;
}
.card-form .rule {
  height: 2px;
  background: #e8ebed;
  margin: 0px 35px;
}
.card-form .form-footer{
  margin: 0 25px 15px 25px;
  padding: 15px 10px;
}
.card-form  .button{
  display: inline-block;
  line-height: 40px;
  border: none;
  border-radius: 10px;
  padding: 1px 20px;
  background: rgb(255, 140, 52);
  margin-right: 10px;
  font-size: 14px;
}
.card-form .form-footer span {
  margin-left: 8px;
}

.example-form .example-container{
  width: 100%;
}

.button{
outline: none;
}

.button:hover{
border: 2px solid rgb(255, 140, 52);
background: white;
color: rgb(255, 140, 52);
}

.example-full-width {
  width: 100%;
}</style>";

        echo "<link href=\"https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap\" rel=\"stylesheet\">";
        echo  "<div align=\"center\">";
        echo "<div class=\"card-form\">";
        // line 1
        echo "<div class=\"form-title\">Senha</div>";
        echo "<div class=\"form-body\">";
        echo "<form action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_resetting_reset", array("token" => (isset($context["token"]) ? $context["token"] : null))), "html", null, true);
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
        echo " method=\"POST\" class=\"fos_user_resetting_reset\">
    ";
        echo "<div class=\"row\">";
        // line 2
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "</div>";
        echo "
    <div>
     <div class=\"rule\"></div>
    <div class=\"form-footer\">
        <input class=\"button\" type=\"submit\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.reset.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
    </div>
    </div>
</form>
";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:reset_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  26 => 2,  19 => 1,);
    }
}
