<?php

namespace devGiants\SeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('devGiantsSeoBundle:Default:index.html.twig');
    }
}
