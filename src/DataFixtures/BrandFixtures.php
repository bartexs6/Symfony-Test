<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brand = new Brand();
        $brand->setName("Nike");
        $brand->setExampleProduct("Air Force 1");
        $brand->setExampleProductPrice(560);
        //$this->addReference('category_1', $brand);
        $brand->addCategory($this->getReference('category_1'));

        $manager->persist($brand);

        $brand2 = new Brand();
        $brand2->setName("Adidas");
        $brand2->setExampleProduct("Forum Low");
        $brand2->setExampleProductPrice(470);
        //$this->addReference('category_1', $brand2);
        $brand2->addCategory($this->getReference('category_1'));

        $manager->persist($brand2);

        $manager->flush();

    }
}
