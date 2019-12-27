<?php

/* FOSUserBundle:Registration:register_content.html.twig */
class __TwigTemplate_da2c3fd9f887a3e0265a2ccc36bb8a99abf7ec66a9a301b8caa851c7bfefecc3 extends Twig_Template
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
font-family: 'Roboto Slab', serif;
margin-right: 50px;
margin-bottom: 15px;
}

#sonata_user_registration_form_username, #sonata_user_registration_form_email, #sonata_user_registration_form_plainPassword_first, #sonata_user_registration_form_plainPassword_second{
float: none;
margin-bottom: 15px;
border-radius: 7px;
outline: none;
width: 300px;
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
}

a.tooltip{
  position:relative; 
  font-size:12px; 
  color:#039;
  text-decoration:none;
  cursor:help; 
  }
 
  a.tooltip:hover{
  background:transparent;
  color:#f00;
  z-index:25; 
 
  }
  a.tooltip span{display: none
  }
 
  a.tooltip:hover span{ 
  display:block;
  position:absolute;
  width:210px; 
  top:20px;
  left:0;
  font-size: 12px;
  padding:5px;
  border:1px solid #999;
  background:#e0ffff; 
  color:#000;
  }
 

</style>";

        echo "<link href=\"https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap\" rel=\"stylesheet\">";
        echo  "<div align=\"center\">";
        echo "<div class=\"card-form\">";
        // line 1


        echo "
  
    <div class=\"form-title\">";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_registration", array(), "SonataUserBundle"), "html", null, true);
        echo "
    </div>
    <div class=\"panel-body\">
    <div class=\"form-body\">
        <form action=\"";
        // line 6
        echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
        echo " method=\"POST\" class=\"fos_user_registration_register form-horizontal\">

            ";

        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');

        echo "
<div class=\"rule\"></div>
            <div class=\"form-actions\">
            <div class=\"form-footer\">
                <input type=\"submit\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("registration.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" class=\"button\" />
            </div>
            </div>
            </div>
        </form>
    </div>
    </div>
</div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:register_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 11,  36 => 8,  29 => 6,  23 => 3,  19 => 1,);
    }
}
