<?php

namespace App\Controller;

use App\Entity\Publicacion;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $user = $this->getUser();
        if($user){
            $em = $this->getDoctrine()->getManager();
            $query = $em->getRepository(Publicacion::class)->Todaslaspublicaciones();
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                4/*limit per page*/
            );
            return $this->render('dashboard/index.html.twig', [
                'pagination' => $pagination
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }
    }
}
