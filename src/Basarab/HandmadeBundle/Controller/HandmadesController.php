<?php

namespace Basarab\HandmadeBundle\Controller;

use Basarab\HandmadeBundle\Entity\Comment;
use Basarab\HandmadeBundle\Entity\Handmade;
use Basarab\HandmadeBundle\Entity\Tag;
use Basarab\HandmadeBundle\Form\CommentType;
use Basarab\HandmadeBundle\Form\HandmadeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandmadesController extends Controller
{
    /**
     * @param Request $request
     * @Route("/handmades/create")
     * @Template
     */
    public function createAction(Request $request)
    {
        $em = $this
            ->getDoctrine()
            ->getManager()
        ;

        if (!$this->getUser()) {
            $this->addFlash('danger', 'Щоб отпримати можливість створювати записи, спочатку треба авторизуватися');

            return new RedirectResponse($this->generateUrl('basarab_handmade_index_index'));
        }

        $handmade = new Handmade();
        $form = $this->createForm(new HandmadeType(), $handmade);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager()
            ;

            $tags = $form->get('tag')->getData();

            foreach ($tags as $tag) {
                $tagRequest = $em->getRepository('BasarabHandmadeBundle:Tag')
                    ->findOneByName($tag);

                if (!$tagRequest) {
                    $newTag = new Tag();
                    $newTag->setName($tag);

                    $handmade->addTag($newTag);
                } else {
                    $handmade->addTag($tagRequest);
                }
            }


            $handmade->setAuthor($this->getUser());

            $em->persist($handmade);
            $em->flush();

            $this->addFlash('success', 'Запис успішно добавлено');

            return new RedirectResponse($this->generateUrl('basarab_handmade_index_index'));
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/handmades/{slug}")
     * @Template()
     */
    public function getAction(Request $request, $slug)
    {
        $em = $this
            ->getDoctrine()
            ->getManager()
        ;

        $handmade = $em
            ->getRepository('BasarabHandmadeBundle:Handmade')
            ->findOneBySlug($slug)
        ;

        if (!$handmade) {
            throw new NotFoundHttpException("Рукоділя з таким ідентифікатором не знайдене!");
        }

        $tags = $em
            ->getRepository('BasarabHandmadeBundle:Tag')
            ->findBy([], [], 10)
        ;

        $comment = new Comment();

        $form = $this->createForm(new CommentType(), $comment);

        return [
            'handmade' => $handmade,
            'tags' => $tags,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/handmade/{slug}/comment")
     */
    public function createComment(Request $request, $slug)
    {
        $em = $this
            ->getDoctrine()
            ->getManager()
        ;

        $handmade = $em
            ->getRepository('BasarabHandmadeBundle:Handmade')
            ->findOneBySlug($slug)
        ;

        if (!$handmade) {
            throw new NotFoundHttpException("Рукоділя з таким ідентифікатором не знайдене!");
        }

        if ($request->isMethod('POST')) {
            $comment = new Comment();

            $form = $this->createForm(new CommentType(), $comment);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $comment->setHandmade($handmade);
                $comment->setAuthor($this->getUser());

                $em->persist($comment);
                $em->flush();

                $this->addFlash('success', 'Комментар успішно створений');
            }
        } else {
            $this->addFlash('danger', 'Метод не підримується');
        }

        return new RedirectResponse($this->generateUrl('basarab_handmade_handmades_get', ['slug' => $slug]));
    }
}
