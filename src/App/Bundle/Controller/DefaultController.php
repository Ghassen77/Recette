<?php

namespace App\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }
    public function indexxAction()
    {
        return $this->render('AppBundle:Default:indexx.html.twig');
    }
}
