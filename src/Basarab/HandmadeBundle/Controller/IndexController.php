<?php

namespace Basarab\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route as Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $handmades = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Handmade')
            ->findAll()
        ;

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $handmades,
            $request->query->getInt('page', 1)/*page number*/,
            16/*limit per page*/
        );

        $tags = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Tag')
            ->findBy([], [], 10)
        ;

        return [
            'pagination' => $pagination,
            'tags' => $tags
        ];
    }
}
