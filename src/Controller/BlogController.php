<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Albums;
use App\Entity\News;
use App\Repository\AlbumsRepository;
use App\Form\NewAlbumType;


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
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albums,
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
     * @Route("/newAlbum", name="newAlbum")
     * @Route("/newAlbum/{id}/edit", name="editAlbum")

     */
    public function formAlbum(Albums $album = null, Request $request, ObjectManager $manager)
    {
        if (!$album) {
            $album = new Albums();
        }
        // $form = $this->createFormBuilder($album)
        //     ->add('title')
        //     ->add('Subtitle')
        //     ->add('Scenario')
        //     ->add('Dessin')
        //     ->add('Couleur')
        //     ->add('date')
        //     ->add('content')
        //     ->add('cover')
        //     ->add('image1')
        //     ->add('image2')
        //     ->add('image3')
        //     ->add('image4')
        //     ->add('image5')
        //     ->add('image6')
        //     ->add('video1')
        //     ->add('video2')
        //     ->getForm();

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
     * @Route("/updateAlbum", name="updateAlbum")
     */
    public function updateAlbum()
    {
        return $this->render('blog/updateAlbum.html.twig');
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
