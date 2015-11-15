<?php

namespace Basarab\HandmadeBundle\Controller;

use Basarab\HandmadeBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersController extends Controller
{
    /**
     * @Route("/users/settings")
     * @Template
     */
    public function settingsAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(new RegistrationType(), $user);

        $form->handleRequest($request);
        if ($form->isValid()) {

        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param $slug
     * @return array
     *
     * @Route("/users/{slug}")
     * @Template()
     */
    public function getAction($slug)
    {
        $user = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:User')
            ->findOneBySlug($slug)
        ;

        if (!$user) {
            throw new NotFoundHttpException("Користувач з таким ідентифікатором не знайдений!");
        }

        return [
            'user' => $user
        ];
    }

    /**
     * @param Request $request
     * @return array
     *
     * @Route("/users")
     * @Template
     */
    public function allAction(Request $request)
    {
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BasarabHandmadeBundle:User')
            ->findAll()
        ;

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return [
            'pagination' => $pagination
        ];
    }
}
