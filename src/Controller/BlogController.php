<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Detail;
use App\Entity\MakingOf;
use App\Entity\News;
use App\Entity\Press;
use App\Entity\Slider;
use App\Form\DetailType;
use App\Form\MakingOfType;
use App\Form\NewAlbumType;
use App\Form\NewsType;
use App\Form\PressType;
use App\Form\SliderType;
use App\Repository\AlbumsRepository;
use App\Repository\DetailRepository;
use App\Repository\MakingOfRepository;
use App\Repository\NewsRepository;
use App\Repository\PressRepository;
use App\Repository\SliderRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    // Route en front

/**
 * @Route("/", name="home")
 */
    public function index(AlbumsRepository $albumsRepository, SliderRepository $sliderRepository, NewsRepository $newsRepository, DetailRepository $detailRepository)
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albumsRepository->findAll(),
            'sliders' => $sliderRepository->findAll(),
            'news' => $newsRepository->findAll(),
            'details' => $detailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/albums", name="mesAlbums")
     */
    public function mesAlbums(AlbumsRepository $albumsRepository, DetailRepository $detailRepository)
    {
        return $this->render('blog/mesalbums.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albumsRepository->findAll(),
            'details' => $detailRepository->findAll(),
        ]);
    }

    // Méthode très simpliée à utiliser lorsque l'on appell un Id

    /**
     * @Route("/albums/{id} ", name="album")
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
    public function allNews(NewsRepository $newsRepository, DetailRepository $detailRepository)
    {
        return $this->render('blog/allNews.html.twig', [
            'controller_name' => 'BlogController',
            'news' => $newsRepository->findAll(),
            'details' => $detailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/news/{id}  ", name="news")
     */
    public function news($id)
    {
        $repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->find($id);
        $repo2 = $this->getDoctrine()->getRepository(Detail::class);
        $details = $repo2->findAll();
        return $this->render('blog/news.html.twig', [
            'news' => $news,
            'details' => $details,
        ]);
    }

    /**
     * @Route("/biographie", name="biographie")
     */
    public function biographie(DetailRepository $detailRepository)
    {
        return $this->render('blog/biographie.html.twig', [
            'controller_name' => 'BlogController',
            'details' => $detailRepository->findAll(),

        ]);
    }

    /**
     * @Route("/allMakingOf", name="allMakingOf")
     */
    public function allMakingOf(MakingOfRepository $allMakingOfRepository, AlbumsRepository $albumsRepository, DetailRepository $detailRepository)
    {
        return $this->render('blog/allMakingOf.html.twig', [
            'controller_name' => 'BlogController',
            'allMakingOfs' => $allMakingOfRepository->findAll(),
            'details' => $detailRepository->findAll(),
            'albums' => $albumsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/makingOf/{id}", name="makingOf")
     */
    public function makingOf($id)
    {
        $repo = $this->getDoctrine()->getRepository(MakingOf::class);
        $makingOfs = $repo->find($id);
        $repo2 = $this->getDoctrine()->getRepository(Detail::class);
        $details = $repo2->findAll();
        return $this->render('blog/makingOf.html.twig', [
            'makingOfs' => $makingOfs,
            'details' => $details,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(DetailRepository $detailRepository)
    {
        return $this->render('blog/contact.html.twig', [
            'controller_name' => 'BlogController',
            'details' => $detailRepository->findAll(),
        ]);

    }

    ///////////////////////////////////////////
    ////////////// ROUTE EN BACK //////////////
    ///////////////////////////////////////////

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(AlbumsRepository $albumsRepository, SliderRepository $sliderRepository, NewsRepository $newsRepository, DetailRepository $detailRepository, MakingOfRepository $allMakingOfRepository, PressRepository $pressRepository)
    {
        return $this->render('blog/admin.html.twig', [
            'controller_name' => 'BlogController',
            'albums' => $albumsRepository->findAll(),
            'sliders' => $sliderRepository->findAll(),
            'news' => $newsRepository->findAll(),
            'details' => $detailRepository->findAll(),
            'allMakingOfs' => $allMakingOfRepository->findAll(),
            'press' => $pressRepository->findAll(),

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
     * @Route("newAlbum", name="newAlbum")
     * @Route("/albums/{id}/edit", name="editAlbum")
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
     * @Route("/createNews", name="createNews")
     * @Route("/news/{id}/edit", name="editNews")
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

            return $this->redirectToRoute('allNews', ['id' => $news->getId()]);
        }
        return $this->render('blog/createNews.html.twig', [
            'controller_name' => 'BlogController',
            'formNews' => $form->createView(),
            'editMode' => $news->getId() !== null,
        ]);
    }

    /**
     * @Route("/newMakingOf", name="newMakingOf")
     * @Route("/makingOf/{id}/edit", name="editMakingOf")
     */
    public function createMakingOf(MakingOf $makingOf = null, Request $request, ObjectManager $manager)
    {

        if (!$makingOf) {
            $makingOf = new MakingOf();
        }
        $form = $this->createForm(MakingOfType::class, $makingOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($makingOf);
            $manager->flush();

            return $this->redirectToRoute('makingOf', ['id' => $makingOf->getId()]);
        }

        return $this->render('blog/createMakingOf.html.twig', [
            'controller_name' => 'BlogController',
            'formMakingOf' => $form->createView(),
            'editMode' => $makingOf->getId() !== null,
        ]);
    }

    /**
     * @Route("/createPress", name="createPress")
     */
    public function formPress(Press $press = null, Request $request, ObjectManager $manager)
    {

        if (!$press) {
            $press = new Press();
        }
        $form = $this->createForm(PressType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($press);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('blog/createPress.html.twig', [
            'controller_name' => 'BlogController',
            'formPress' => $form->createView(),
            'editMode' => $press->getId() !== null,
        ]);
    }

    /**
     * @Route("/createDetail", name="createDetail")
     */
    public function formDetail(Press $detail = null, Request $request, ObjectManager $manager)
    {

        if (!$detail) {
            $detail = new Detail();
        }
        $form = $this->createForm(DetailType::class, $detail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($detail);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('blog/createDetail.html.twig', [
            'controller_name' => 'BlogController',
            'formDetail' => $form->createView(),
            'editMode' => $detail->getId() !== null,
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
