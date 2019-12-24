<?php
namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin.acc")
     */
    public function index(){
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/admin", name="admin.service.show")
     */
    public function showService(ServiceRepository $repo )
    {
        $services = $repo->findAll();
         
        return $this->render('admin/show.html.twig', [
            'services' => $services,
        ]);
    }

     /**
     * @Route("/admin/add", name="admin.service.add")
     */
    public function addService(Request $request )
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();
            $this->addFlash('success', 'Service créé avec succes');

        return $this->redirectToRoute('admin.service.show');
    }

        return $this->render('admin/add.html.twig', [
            'formService' => $form->createView()
        ]);
}       

    /**
     * @Route("/admin/{id}", name="admin.service.edit", methods="GET|POST")
     */
    public function editService(Service $service, Request $request )
    {

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Service modifier avec succes');

        return $this->redirectToRoute('admin.service.show');
    }

        return $this->render('admin/edit.html.twig', [
        'service' => $service,
        'form' => $form->createView()
    ]);
       
    }
     /**
     * @Route("/admin/{id}", name="admin.service.delete", methods="DELETE")
     */
    public function deleteService(Service $service, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $service->getId(), $request->get('_token'))){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }           
            return $this->redirectToRoute('admin.service.show');
    }
}
