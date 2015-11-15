<?php
namespace Basarab\HandmadeBundle\DataFixtures\ORM;

use Basarab\HandmadeBundle\Entity\Handmade;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HandmadesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $handmade1 = new Handmade();
        $handmade1->setName("Рукоділля 1");
        $handmade1->setText("Опис рукоділля 1");

        $manager->persist($handmade1);
        $manager->flush();

        $handmade2 = new Handmade();
        $handmade2->setName("Рукоділля 2");
        $handmade2->setText("Опис рукоділля 2");

        $manager->persist($handmade2);
        $manager->flush();
    }
}