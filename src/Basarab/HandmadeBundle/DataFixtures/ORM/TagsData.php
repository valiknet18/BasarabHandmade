<?php
namespace Basarab\HandmadeBundle\DataFixtures\ORM;

use Basarab\HandmadeBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $handmade1 = new Tag();
        $handmade1->setName("Тег 1");

        $manager->persist($handmade1);
        $manager->flush();

        $handmade2 = new Tag();
        $handmade2->setName("Тег 2");

        $manager->persist($handmade2);
        $manager->flush();
    }
}