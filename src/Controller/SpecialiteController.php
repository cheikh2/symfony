<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecialiteController extends AbstractController
{
    /**
     * @Route("/specialite", name="specialite.specialite.showS")
     */
    public function showS(SpecialiteRepository $repo )
    {
        $specialites = $repo->findAll();
         
        return $this->render('specialite/showS.html.twig', [
            'specialites' => $specialites,
        ]);
    }

     /**
     * @Route("/specialite/addS", name="specialite.specialite.addS")
     */
    public function addS(Request $request )
    {
        $specialite = new Specialite();
        $form = $this->createForm(SpecialiteType::class, $specialite);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($specialite);
             $entityManager->flush();
             $this->addFlash('success', 'Specialite créé avec succes');

        return $this->redirectToRoute('specialite.specialite.showS');
    }

        return $this->render('specialite/addS.html.twig', [
            'formSpecialite' => $form->createView()
        ]);
}     

    /**
     * @Route("/specialite/{id}", name="specialite.specialite.editS", methods="GET|POST")
     */
    public function editS(Specialite $specialite, Request $request )
    {

        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Specialite modifier avec succes');

        return $this->redirectToRoute('specialite.specialite.showS');
    }

        return $this->render('specialite/editS.html.twig', [
        'specialite' => $specialite,
        'form' => $form->createView()
    ]);
       
    }

    /**
    * @Route("/specialite/{id}", name="specialite.specialite.delete", methods="DELETE")
    */
   public function deleteS(Specialite $specialite, Request $request)
   {
       if($this->isCsrfTokenValid('delete' . $specialite->getId(), $request->get('_token'))){
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->remove($specialite);
           $entityManager->flush();
       }           
           return $this->redirectToRoute('specialite.specialite.showS');
   }
}
