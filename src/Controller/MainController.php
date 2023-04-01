<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/clothes/{brand}', name: 'home', defaults: ['brand' => null], methods:['GET', 'HEAD'])]    

    public function index($brand): Response
    {
        return $this->render('index.html.twig', ['title' => $brand]);

        /*
        JSON
        return $this->json([
            'message' => $brand,
            'path' => 'src/Controller/MainController.php',
        ]);*/

    }
}
