<?php

namespace AM\ExpressBundle\Controller;

use AM\ExpressBundle\Entity\Category;
use AM\ExpressBundle\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    public function indexAction()
    {
       return $this->render('AMExpressBundle:Default:index.html.twig');

    }


    public function navigationAction()
    {
        return $this->render('AMExpressBundle:Components:navigation.html.twig');

    }
}
