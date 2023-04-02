<?php

namespace App\DataFixtures;

use App\Entity\BrandSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandSizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fh = fopen('C:\Users\PC\Desktop\SymfonyPHP\SymfonyTest\src\DataFixtures\outleysize.txt','r');
        while ($line = fgets($fh)) {
            $brandSize = new BrandSize();
            $brandSize->setSize($line);

            $manager->persist($brandSize);
        }
        fclose($fh);

        $manager->flush();

    }
}
