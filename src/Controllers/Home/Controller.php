<?php

namespace Assmat\Controllers\Home;

use Twig_Environment;

class Controller
{
    private
        $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function indexAction()
    {
        return $this->twig->render('Home/index.html.twig');
    }
    
    public function errorAction()
    {
        return $this->twig->render('Error/index.html.twig');
    }
}