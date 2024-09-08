<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Region;
use App\Form\OffreType;
use App\Entity\RegionSearch;
use App\Form\RegionSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class OffreController extends AbstractController
{
    /**
 * @Route("/offre", name="newOffre")
 * Method({"GET", "POST"})
 */
 public function new(Request $request) {
  $offres = new Offre();
  $form = $this->createForm(OffreType::class,$offres);
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
  $offres = $form->getData();
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($offres);
  $entityManager->flush();
  }
  if($form->isSubmitted() && $form->isValid()) {
    $file = $offres->getImage();
    $fileName =md5(uniqid()).'.'.$file->guessExtension();
    try{
      $file->move(
        $this->getParameter('images_directory'),
        $fileName
      );
      
    }
    catch(FileException $e){  
    }
    $entityManager= $this->getDoctrine()->getManager();
    $offres->setImage($fileName);
    $entityManager->persist($offres);
    $entityManager->flush();
   return $this->redirectToRoute('offre_list');
    }
  
  return $this->render('offre/new.html.twig',['form' => $form->createView()]);

  }
  /** 
     *@Route("/list",name="offre_list") 
  */ 
public function home(Request $request) 
{ 
  
    $offres= $this->getDoctrine()->getRepository(Offre::class)->findAll(); 
    return $this->render('offre/index.html.twig',['offres'=> $offres,]); 

  }


/**
 * @Route("/modifier/{id}", name="edit_offre")
 * Method({"GET", "POST"})
 */
public function edit(Request $request, $id) {
  $offres = new Offre();
  $offres = $this->getDoctrine()->getRepository(Offre::class)->find($id);
  $form = $this->createFormBuilder($offres)
  ->add('type_offre')
            ->add('description',TextareaType::class)
            ->add('date_creation')
            ->add('surface')
            ->add('prix')
            ->add('animaux')
            ->add('femeur')
            ->add('meuble')
            ->add('numeroTel')
            // ->add('image',FileType::class,['label'=> 'Image'])
            ->add('coloc_occup')
            ->add('region',EntityType::class,['class' => Region::class,
            'choice_label' => 'libelle',
            'label' => 'Region'])->getForm();
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($offres);
  $entityManager->flush();
  return $this->redirectToRoute('offre_list');
  }
  return $this->render('offre/edit.html.twig', ['form' => $form->createView()]);
 }

  /**
 * @Route("/offre/delete/{id}", name="delete_offre")
 * 
*/
public function delete(Request $request, $id) {
  $offres= $this->getDoctrine()->getRepository(Offre::class)->find($id);
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->remove($offres);
  $entityManager->flush();
  $response = new Response();
  $response->send();
  return $this->redirectToRoute('offre_list');
  }
    /**
  * @Route("/offres/{id}", name="offre_show")
 */
public function show($id) {
  $offres = $this->getDoctrine()->getRepository(Offre::class)->find($id);
  return $this->render('offre/show.html.twig',
  ['offres'=> $offres,]);
   }

   /** 
     * @Route("/list", name="offre_list") 
     * Method({"GET", "POST"}) 
     */ 
    public function offreRegion(Request $request) { 
      $regionSearch = new RegionSearch(); 
      $form = $this->createForm(RegionSearchType::class,$regionSearch); 
      $form->handleRequest($request); 
 
      $offres= [];
      if($form->isSubmitted() && $form->isValid()) { 
        $region = $regionSearch->getRegion(); 
        
        if ($offres!="")  
        $offres= $region->getOffre(); 
        else    
      $offres= $this->getDoctrine()->getRepository(Offre::class)->findAll(); 
        } 
       
      return $this->render('offre/index.html.twig',['form' => $form->createView(),'offres' => $offres]); 
    

  } 
}
