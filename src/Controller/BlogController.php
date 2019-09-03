<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Albums;
use App\Entity\News;
use App\Entity\Slider;
use App\Repository\AlbumsRepository;
use App\Form\NewAlbumType;
use App\Form\SliderType;


class BlogController extends AbstractController
{
    // Route en front

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Albums::class);
        $albums = $repo->findAll();
        $repo2 = $this->getDoctrine()->getRepository(Slider::class);
        $sliders = $repo2->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albums,
            'sliders' =>$sliders,

        ]);
    }

    // Méthode simplifié avec injection de dépendances - on créée la variable repo en appelant la fonction
    /**
     * @Route("/mesAlbums", name="mesAlbums")
     */
    public function mesAlbums(AlbumsRepository $repo)
    {
        $albums = $repo->findAll();
        return $this->render('blog/mesalbums.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albums,
        ]);
    }

    // Méthode très simpliée à utiliser lorsque l'on appell un Id

    /**
     * @Route("/album/{id}  ", name="album")
     */
    public function album(Albums $album) // au lieu de public function album($id)

    {
        // $repo = $this->getDoctrine()->getRepository(Albums::class);
        // $album = $repo->find($id);
        return $this->render('blog/album.html.twig', [
            'album' => $album,
        ]);
    }

    /**
     * @Route("/news/{id}  ", name="news")
     */
    public function news($id)
    {
        $repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->find($id);
        return $this->render('blog/news.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/biographie", name="biographie")
     */
    public function biographie()
    {
        return $this->render('blog/biographie.html.twig');
    }

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agenda()
    {
        return $this->render('blog/contact.html.twig');
    }

    /**
     * @Route("/makingOf", name="makingOf")
     */
    public function makingOf()
    {
        return $this->render('blog/makingOf.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('blog/contact.html.twig');
    }


    // route en back

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('blog/admin.html.twig');
    }

/**
     * @Route("/newSlider", name="newSlider")
     * @Route("/newSlider/{id}/edit", name="editSlider")

     */
    public function formSlider(Slider $slider = null, Request $request, ObjectManager $manager)
    {
        if (!$slider) {
            $slider = new Slider();
        }

        $form = $this->createForm(SliderType::class, $slider);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($slider);
            $manager->flush();

            return $this->redirectToRoute('slider', ['id' => $slider->getId()]);
        }

        return $this->render('blog/createSlider.html.twig', [
            'formSlider' => $form->createView(),
            'editMode' => $slider->getId() !== null,
        ]);
    }


    /**
     * @Route("/newAlbum", name="newAlbum")
     * @Route("/newAlbum/{id}/edit", name="editAlbum")

     */
    public function formAlbum(Albums $album = null, Request $request, ObjectManager $manager)
    {
        if (!$album) {
            $album = new Albums();
        }

        $form = $this->createForm(NewAlbumType::class, $album);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute('album', ['id' => $album->getId()]);
        }

        return $this->render('blog/createAlbum.html.twig', [
            'formAlbum' => $form->createView(),
            'editMode' => $album->getId() !== null,
        ]);
    }

    /**
     * @Route("/updateAlbum/{id}", name="updateAlbum")
     */
    public function updateAlbum(Albums $album)
    {
        return $this->render('blog/updateAlbum.html.twig', [
            'album' => $album,
        ]);
    }

    /**
     * @Route("/createNews", name="createNews")
     */
    public function createNews()
    {
        return $this->render('blog/createNews.html.twig');
    }

    /**
     * @Route("/updateNews", name="updateNews")
     */
    public function updateNews()
    {
        return $this->render('blog/updateNews.html.twig');
    }
}
