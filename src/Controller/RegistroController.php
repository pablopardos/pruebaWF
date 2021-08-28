<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registrousuario", name="registrousuario")
     */

    public function index(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setPassword($this->passwordHasher->hashPassword($user,$form['password']->getData()));
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito',User::REGISTRO_EXITOSO);
            return $this->redirectToRoute('registrousuario');
        }

        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'form' => $form->createView()
        ]);
    }
}
