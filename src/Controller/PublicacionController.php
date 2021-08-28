<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Form\Publicacion1Type;
use App\Repository\PublicacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/publicacion" , name="publicacion")
 */
class PublicacionController extends AbstractController
{
    /**
     * @Route("/", name="publicacion_index", methods={"GET"})
     */
    public function index(PublicacionRepository $publicacionRepository): Response
    {
        return $this->render('publicacion/index.html.twig', [
            'publicacions' => $publicacionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="publicacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publicacion = new Publicacion();
        $form = $this->createForm(Publicacion1Type::class, $publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $publicacion->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicacion);
            $entityManager->flush();

            return $this->redirectToRoute('publicacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publicacion/new.html.twig', [
            'publicacion' => $publicacion,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="publicacion_show", methods={"GET"})
     */
    public function show(Publicacion $publicacion): Response
    {
        return $this->render('publicacion/show.html.twig', [
            'publicacion' => $publicacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publicacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicacion $publicacion): Response
    {
        $form = $this->createForm(Publicacion1Type::class, $publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publicacion/edit.html.twig', [
            'publicacion' => $publicacion,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="publicacion_delete", methods={"POST"})
     */
    public function delete(Request $request, Publicacion $publicacion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publicacion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publicacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publicacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
