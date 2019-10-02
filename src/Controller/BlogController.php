<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Albums;
use App\Entity\MakingOf;
use App\Entity\News;
use App\Entity\Slider;

use App\Repository\AlbumsRepository;
use App\Repository\MakingOfRepository;
use App\Repository\NewsRepository;
use App\Repository\SliderRepository;

use App\Form\NewAlbumType;
use App\Form\SliderType;
use App\Form\NewsType;
use App\Form\MakingOfType;


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
        $repo3 = $this->getDoctrine()->getRepository(News::class);
        $news = $repo3->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albums,
            'sliders' => $sliders,
            'news' => $news,

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
     * @Route("/allNews  ", name="allNews")
     */
    public function allNews()
    {
        $repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->findAll();
        return $this->render('blog/allNews.html.twig', [
            'news' => $news,
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
        $form = $this->createForm(NewAlbumType::class, $album);
        $form->handleRequest($request);

        // Pour essayer de réparer le edit
        // $album->setCoverName(
        //     new File($this->getParameter('cover_image').'/'.$album->getCoverName())
        // );

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
     * @Route("/newSlider", name="newSlider")
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

            return $this->redirectToRoute('home');
        }

        return $this->render('blog/createSlider.html.twig', [
            'formSlider' => $form->createView(),
        ]);
    }

 /**
     * @Route("/newMakingOf", name="newMakingOf")
     */
    public function formMakingOf(MakingOf $makingOf = null, Request $request, ObjectManager $manager)
    {

        if (!$makingOf) {
            $makingOf = new MakingOf();
        }
        $form = $this->createForm(MakingOfType::class, $makingOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($makingOf);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('blog/createMakingOf.html.twig', [
            'formMakingOf' => $form->createView(),
        ]);
    }


    /**
     * @Route("/createNews", name="createNews")
     */
    public function createNews(News $news = null, Request $request, ObjectManager $manager)
    {
        if (!$news) {
            $news = new News();
        }
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('allNews');
        }
        return $this->render('blog/createNews.html.twig', [
            'formNews' => $form->createView(),
        ]);
    }

    /**
     * @Route("/updateNews", name="updateNews")
     */
    public function updateNews()
    {
        return $this->render('blog/updateNews.html.twig');
    }
}
