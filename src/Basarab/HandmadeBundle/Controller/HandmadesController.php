<?php

namespace Basarab\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandmadesController extends Controller
{
    /**
     * @Route("/handmades/{slug}")
     * @Template()
     */
    public function getAction($slug)
    {
        $handmade = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Handmade')
            ->findOneBySlug($slug)
        ;

        if (!$handmade) {
            throw new NotFoundHttpException("Рукоділя з таким ідентифікатором не знайдене!");
        }

        $tags = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:Tag')
            ->findBy([], [], 10)
        ;

        return [
            'handmade' => $handmade,
            'tags' => $tags,
        ];
    }
}
