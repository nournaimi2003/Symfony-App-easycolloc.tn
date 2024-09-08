<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegionController extends AbstractController
{
  /**
 * @Route("/newRegion", name="new_Region")
 * Method({"GET", "POST"})
 */
 public function newRegion(Request $request) {
  $region = new Region();
  $form = $this->createForm(RegionType::class,$region );
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
  $region = $form->getData();
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($region);
  $entityManager->flush();
   return $this->redirectToRoute('region_list');
  }
 return $this->render('region/new.html.twig',['form'=>
 $form->createView()]);
}
/**
 * @Route("edit/{id}", name="edit_Region")
 * Method({"GET", "POST"})
 */
public function edit(Request $request, $id) {
  $region = new Region();
  $region = $this->getDoctrine()->getRepository(Region::class)->find($id);
  $form = $this->createFormBuilder($region)
  ->add('libelle', TextType::class)
  ->getForm();
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->flush();
  
   return $this->redirectToRoute('region_list');
  }
  return $this->render('region/edit.html.twig', ['form' => $form->createView()]);

 }
   /** 
     *@Route("/region",name="region_list") 
  */ 
public function home(Request $request) 
{ 
    //récupérer tous les articles de la table article de la BD  
  // et les mettre dans le tableau $articles 
    $region= $this->getDoctrine()->getRepository(Region::class)->findAll(); 
    return $this->render('region/index.html.twig',['region'=> $region,]); 

  }

}
