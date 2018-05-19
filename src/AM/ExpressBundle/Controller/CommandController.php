<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 17/05/2018
 * Time: 11:18
 */

namespace AM\ExpressBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandController extends Controller
{

    public function indexAction()
    {
        return $this->render('AMExpressBundle:Command:index.html.twig');

    }
}