<?php

namespace App\Controller;

use App\Entity\Activites;
use App\Entity\Categorie;
use App\Form\ActivitesType;
use App\Repository\ActivitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/activites")
 */
class ActivitesController extends AbstractController
{








    /**
     * @Route("/", name="activites_index", methods={"GET"})
     */
    public function index(ActivitesRepository $activitesRepository): Response
    {
       
            $activites = $activitesRepository->findAll();
     
        return $this->render('activites/index.html.twig', [
            'activites' => $activites,
        ]);
    }

    /**
     * @Route("/listall/{query?}/{publicAccess?}", name="activites_list", methods={"GET"})
     */
    public function listall($query, $publicAccess, ActivitesRepository $activitesRepository ,AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $activites = [];
        if (isset($query) || isset($publicAccess)){
            $activites = $activitesRepository->findAllArrayUser($query, $publicAccess);
        }else{
            $activites = $activitesRepository->findAllArrayUser2();
        }

        // return new JsonResponse($activites);
        return $this->render('activites/listall.html.twig', [
            'activites' => $activites,
            'last_username' => $lastUsername, 'error' => $error,
        ]);
    }








    public function list(ActivitesRepository $activitesRepository): Response
    {
        //$entityManager = $this->getDoctrine()->getManager();

        // $listAuteur = $entityManager->getRepository(Auteur::class)->findAll();
        
        $this->denyAccessUnlessGranted("ROLE_USER");

        $listActivites = $activitesRepository->findBy(array(), array('titre' => 'DESC'));

        return $this->render('activites/index.html.twig', [
            'list_activites' => $listActivites,
            'toto' => 'titi'
        ]);
    }

    public function search($query, ActivitesRepository $activitesRepository, LoggerInterface $logger) {
       
      

        // $listActivites= $activitesRepository->findBy(array(), array('nom' => 'DESC'));
        // $listActivites = $activitesRepository->findAllArray();

        // $listActivites = $activitesRepository->findAllArrayWithTitre($query);
        $listActivites = $activitesRepository->findAllArray($query);
        
        $logger->info($query);


        // return $this->json($listAuteur);
        return new JsonResponse($listActivites);

         
    }

   
    public function searchquery(Request $request, ActivitesRepository $activitesRepository)
    {   
        $q = $request->query->get("query");
        $listActivites = $activitesRepository->findAllArray($q);

        return new JsonResponse($listActivites);
    }



    /**
     * @Route("/new", name="activites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $activite = new Activites();
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $activite->setUser($this->getUser());
       

          /** @var UploadedFile $brochureFile */
          $brochureFil = $form->get('image')->getData();

          // this condition is needed because the 'brochure' field is not required
          // so the PDF file must be processed only when a file is uploaded
          if ($brochureFil) {
              $originalFilename = pathinfo($brochureFil->getClientOriginalName(), PATHINFO_FILENAME);
              // this is needed to safely include the file name as part of the URL
              $newFilename = uniqid().'.'.$brochureFil->guessExtension();

              // Move the file to the directory where brochures are stored
              try {
                  $brochureFil->move(
                      $this->getParameter('brochures_director'),
                      $newFilename
                  );
              } catch (FileException $e) {
                  // ... handle exception if something happens during file upload
              }

              // updates the 'brochureFilename' property to store the PDF file name
              // instead of its contents                                          
             
              $activite->setImage($newFilename);
          }
            
            $activite->setLatitude(0);
            $activite->setLongitude(0);

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($activite);
          $entityManager->flush();
            
            return $this->redirectToRoute('home');
        }

        return $this->render('activites/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="activites_show", methods={"GET"})
     */
    public function show(Activites $activite,ActivitesRepository $activitesRepository,AuthenticationUtils $authenticationUtils): Response
    {


         // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $activites = $activitesRepository->findAll();
        
        return $this->render('activites/show.html.twig', [
            'activite' => $activite,
            'activites' => $activites,
            'controller_name' => 'HomeReactController',
            'last_username' => $lastUsername, 'error' => $error,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="activites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activites $activite): Response
    {
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          


          /** @var UploadedFile $brochureFile */
          $brochureFil = $form->get('image')->getData();
          

          // this condition is needed because the 'brochure' field is not required
          // so the PDF file must be processed only when a file is uploaded
          if ($brochureFil) {
              $originalFilename = pathinfo($brochureFil->getClientOriginalName(), PATHINFO_FILENAME);
              // this is needed to safely include the file name as part of the URL
              $newFilename = uniqid().'.'.$brochureFil->guessExtension();

              // Move the file to the directory where brochures are stored
              try {
                  $brochureFil->move(
                      $this->getParameter('brochures_director'),
                      $newFilename
                  );
              } catch (FileException $e) {
                  // ... handle exception if something happens during file upload
              }

              // updates the 'brochureFilename' property to store the PDF file name
              // instead of its contents                                          
             
              $activite->setImage($newFilename);
          }
          
          $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('activites_index');
        }

        return $this->render('activites/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activites_delete", methods={"POST"})
     */
    public function delete(Request $request, Activites $activite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activites_index');
    }
    
}
