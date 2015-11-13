<?php

namespace Basarab\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BasarabHandmadeBundle:Default:index.html.twig', array('name' => $name));
    }
}
