<?php

namespace App\Controller;

use App\Entity\BrandSize;
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

    private function correctSize($sizesArray){
        for ($i=0; $i < count($sizesArray); $i++) { 
            if(!is_numeric($sizesArray[$i]) && !preg_match('/\d{1,3}\s+(?=\d)\d+\/\d+/', $sizesArray[$i])){
                $sizesArray[$i] = preg_replace('/\s+/', '', $sizesArray[$i]);
                $sizesArray[$i] = str_replace(",", ".", $sizesArray[$i]);
            }
        }

        return $sizesArray;
    }

    private function sortSize($sizesArray){

        $arraySize = count($sizesArray);

        if($arraySize <= 1) 
            return $sizesArray;

        for ($i=0; $i < $arraySize; $i++) {

        }

        $pivot = $sizesArray[0];
        $leftSide = $rightSide = array();

        for($i = 1; $i < $arraySize; $i++) {
                if($sizesArray[$i] < $pivot) {
                    $leftSide[] = $sizesArray[$i];
                } else {
                    $rightSide[] = $sizesArray[$i];
                }
        }

        return array_merge($this->sortSize($leftSide), array($pivot), $this->sortSize($rightSide));
    }

    #[Route('/clothes/{brand}', name: 'home')]    

    public function index(): Response
    {
        /*$repository = $this->em->getRepository(Brand::class);
        $brands = $repository->findBy([], ['id' => 'DESC']);

        dump($brands);
        dump($repository->count([]));
        dump($repository->getClassName());*/

        $repository = $this->em->getRepository(BrandSize::class);
        $brandSizes = $repository->findBy([], ['id' => 'DESC']);

        $sizeTab = [];
        foreach ($brandSizes as $size) {
            array_push($sizeTab, $size->getSize());
        }
        $brandSizes = $this->sortSize($this->correctSize($sizeTab));

        return $this->render('index.html.twig', ['brandSizes' => $brandSizes]);

        /*
        JSON
        return $this->json([
            'message' => $brand,
            'path' => 'src/Controller/MainController.php',
        ]);*/

    }

    
}
