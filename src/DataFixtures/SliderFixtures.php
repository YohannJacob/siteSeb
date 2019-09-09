<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Slider;


class SliderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $slider = new Slider();
            $slider->setImage("https://via.placeholder.com/568x378")
                ->setTitle("Titre n°$i")
                ->setSubtitle("SousTitre n°$i")
                ->setPosition("$i")
                ->setLink("test");
            $manager->persist($slider);
        }

        $manager->flush();
    }
}
