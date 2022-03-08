<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeReactController extends AbstractController
{
    /**
     * @Route("/home/react", name="home_react")
     */
    public function index(): Response
    {
        return $this->render('home_react/index.html.twig', [
            'controller_name' => 'HomeReactController',
        ]);
    }
}
