<?php

namespace AM\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AMUserBundle:Default:index.html.twig');
    }
}
