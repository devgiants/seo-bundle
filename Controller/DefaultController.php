<?php

namespace Devgiants\SeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DevgiantsSeoBundle:Default:index.html.twig');
    }
}
