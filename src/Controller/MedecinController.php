<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecin.medecin.showMed")
     */
    public function showMed(MedecinRepository $repo )
    {
        $medecins = $repo->findAll();
         
        return $this->render('medecin/showMed.html.twig', [
            'medecins' => $medecins,
        ]);
    }

     /**
     * @Route("/medecin/addMed", name="medecin.medecin.addMed")
     */
    public function addMedecin(Request $request, MedecinRepository $repo)
    {
        $idMatricule = $this->getLastMedecin() + 1;
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $twoFirstLetter =\strtoupper(\substr($medecin->getService()->getLibelle(),0,2));
            $longId = strlen((string)$idMatricule);
            //La longueur total du matricule = 8 ex =MLA00001
            $matricule = \str_pad("M".$twoFirstLetter,8 - $longId,"0").$idMatricule;
            $medecin->setMatricule($matricule);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medecin);
            $entityManager->flush();
            $this->addFlash('success', 'Medecin créé avec succes');

        return $this->redirectToRoute('medecin.medecin.showMed');
    }
        return $this->render('medecin/addMed.html.twig', [
            'formMedecin' => $form->createView(),
        ]);
}    

    // Recuperation du dernier medecin

    public function getLastMedecin()
    {
        $reto = $this->getDoctrine()->getRepository(Medecin::class);
        $medecinLast = $reto->findBy([],['id'=>'DESC']);
        if($medecinLast == null){
            return $id = 0;
        }
        else
        {
            return $medecinLast[0]->getId();
        }
        
    }

    /**
     * @Route("/medecin/{id}", name="medecin.medecin.editMed", methods="GET|POST")
     */
    public function editMedecin(Medecin $medecin, Request $request )
    {

        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Medecin modifier avec succes');

        return $this->redirectToRoute('medecin.medecin.showMed');
    }

        return $this->render('medecin/editMed.html.twig', [
        'medecin' => $medecin,
        'form' => $form->createView()
    ]);
       
    }

    /**
    * @Route("/medecin/{id}", name="medecin.medecin.delete", methods="DELETE")
    */
   public function deleteMedecin(Medecin $medecin, Request $request)
   {
       if($this->isCsrfTokenValid('delete' . $medecin->getId(), $request->get('_token'))){
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->remove($medecin);
           $entityManager->flush();
       }           
           return $this->redirectToRoute('medecin.medecin.showMed');
   }

}
