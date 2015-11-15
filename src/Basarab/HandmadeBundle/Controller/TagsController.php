<?php

namespace Basarab\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagsController extends Controller
{
    /**
     * @param $slug
     * @return array
     *
     * @Route("/tags/{slug}")
     * @Template
     */
    public function getAction($slug)
    {
        $tag = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Tag')
            ->findOneBySlug($slug)
        ;

        if (!$tag) {
            throw new NotFoundHttpException("По заданому ідентифікатору не знайдений ні один тег!");
        }

        return [
            'tag' => $tag
        ];
    }

    /**
     * @return array
     *
     * @Route("/tags")
     * @Template
     */
    public function allAction(Request $request)
    {
        $tags = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Tag')
            ->findAll()
        ;

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tags,
            $request->query->getInt('page', 1)/*page number*/,
            16/*limit per page*/
        );

        return [
            'pagination' => $pagination
        ];
    }
}
