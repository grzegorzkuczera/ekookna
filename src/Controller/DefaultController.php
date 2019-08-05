<?php

namespace App\Controller;
use App\Form\BusStationType;
use App\Entity\BusStation;
Use App\Entity\File;
use App\Service\FileUploader;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_index")
     */
    public function index( Request $request, FileUploader $fileUploader)
    {
        $busStation = new BusStation();
        
        $form = $this->createForm(
            BusStationType::class,
            $busStation
        );
 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           $attachments = $form['attachments']->getData();
           if ($attachments) {
               foreach ($attachments as $attachment) {
                   $fileUploaded = $fileUploader->upload($attachment);
                   $file = new File();
                   $file->setFileName($fileUploaded['filename'])
                        ->setFileExtension($fileUploaded['extension'])
                        ->setFileSize($fileUploaded['size']);
                    $busStation->addFile($file);          
               }
               $entityManager = $this->getDoctrine()
                    ->getManager();
               $entityManager->persist($busStation);
               $entityManager->flush();
               
               $this->addFlash('success', 'Files is attaches to the system');

               return $this->redirectToRoute('default_index');
           }
          
        }   
        
        return $this->render('default/index.html.twig', ['form' => $form->createView()]);
    }
}
