<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\News;

class NewsFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++){
            $news = new news();
            $news->setTitle("Titre de la news n°$i")
                ->setContent("<p>Texte de la news en quelques lignes.</p>")
                ->setImage("https://via.placeholder.com/250")
                ->setCreatedAt(new \DateTime());
            $manager->persist($news);

        $manager->flush();
    }
}
}