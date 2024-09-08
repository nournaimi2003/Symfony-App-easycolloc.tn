<?php

namespace App\Controller;
use App\Entity\Offre;
use App\Repository\OffreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(OffreRepository $repository): Response
    {
      $offres = $repository->findAll();
        return $this->render('front/index.html.twig', [
            'offres' => $offres ,
        ]);
    }
    /**
 * @Route("/offre/{id}", name="offre-show")
 */
public function show($id) {
  $offres = $this->getDoctrine()->getRepository(Offre::class)->find($id);
  return $this->render('front/show.html.twig',
  array('offres' => $offres));
   }
}
