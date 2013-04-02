<?php

/* main.html */
class __TwigTemplate_bc0b0129dc56e01ff96748f49fdc3b46 extends Twig_Template
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
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>Jawa Assessoria Contabil</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
        <div>
            Olá ";
        // line 9
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        echo twig_escape_filter($this->env, $_name_, "html", null, true);
        echo "
        </div>
        <div>
            BODY
        </div>
        <div>
            FOOTER
        </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 9,  19 => 1,);
    }
}
