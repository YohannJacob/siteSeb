<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Albums;


class AlbumsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++){
            $album = new Albums();
            $album->setTitle("Titre de l'album n°$i")
                        ->setSubtitle("SousTitre n°$i")
                        ->setScenario("Sébastien Mao")
                        ->setDessin("dessinateur")
                        ->setCouleur("coloriste")
                        ->setDate(new \DateTime())
                        ->setContent("<p>Texte de présentation de l'album de quelques lignes.</p>")
                        ->setBuyLink("http://google.html")
                        ->setCover("https://via.placeholder.com/270x367")
                        ->setImage1("https://via.placeholder.com/568x378")
                        ->setImage2("https://via.placeholder.com/568x378")
                        ->setImage3("https://via.placeholder.com/568x378")
                        ->setImage4("https://via.placeholder.com/568x378")
                        ->setImage5("https://via.placeholder.com/568x378")
                        ->setImage6("https://via.placeholder.com/568x378");
            $manager->persist($album);
            }

        $manager->flush();
    }
}
