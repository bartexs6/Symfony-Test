<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/clothes/{brand}', name: 'home')]    

    public function index(): Response
    {
        $repository = $this->em->getRepository(Brand::class);
        $brands = $repository->findBy([], ['id' => 'DESC']);

        dump($brands);
        dump($repository->count([]));
        dump($repository->getClassName());

        return $this->render('index.html.twig', ['brands' => $brands]);

        /*
        JSON
        return $this->json([
            'message' => $brand,
            'path' => 'src/Controller/MainController.php',
        ]);*/

    }
}
