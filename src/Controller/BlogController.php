<?php

namespace App\Controller;

use App\Entity\AlbumImage;
use App\Entity\Albums;
use App\Entity\Contact;
use App\Entity\Detail;
use App\Entity\MakingOf;
use App\Entity\News;
use App\Entity\Press;
use App\Entity\Slider;
use App\Entity\User;
use App\Form\AlbumImageType;
use App\Form\ContactType;
use App\Form\DetailType;
use App\Form\MakingOfType;
use App\Form\NewAlbumType;
use App\Form\NewsType;
use App\Form\PressType;
use App\Form\SliderType;
use App\Repository\AlbumImageRepository;
use App\Repository\AlbumsRepository;
use App\Repository\DetailRepository;
use App\Repository\MakingOfRepository;
use App\Repository\NewsRepository;
use App\Repository\PressRepository;
use App\Repository\SliderRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        // // usually you'll want to make sure the user is authenticated first
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
    public function album($id)
    {
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(Albums::class);
        $albums = $repo->find($id);

        $repo2 = $this->getDoctrine()->getRepository(Detail::class);
        $details = $repo2->findAll();

        $repo3 = $this->getDoctrine()->getRepository(Press::class);
        $presses = $repo3->findBy(
            ['album' => $albums->getId()], );

        $repo4 = $this->getDoctrine()->getRepository(AlbumImage::class);
        $makingOfs = $repo4->findBy(
            ['Album' => $albums->getId()], );

        return $this->render('blog/album.html.twig', [
            'albums' => $albums,
            'details' => $details,
            'presses' => $presses,
            'makingOfs' => $makingOfs,
        ]);
    }

    /**
     * @Route("/allNews  ", name="allNews")
     */
    public function allNews(Request $request, DetailRepository $detailRepository, PaginatorInterface $paginator)
    {
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(News::class);
        $newsRepository = $repo->findAll();

        $articles = $paginator->paginate(
            $newsRepository, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            7// Nombre de résultats par page
        );

        return $this->render('blog/allNews.html.twig', [
            'controller_name' => 'BlogController',
            'news' => $articles,
            'details' => $detailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/allNewsOld  ", name="allNewsOld")
     */
    public function allNewsOld(Request $request, DetailRepository $detailRepository, PaginatorInterface $paginator)
    {
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(News::class);
        $newsRepository = $repo->findAll();

        $articles = $paginator->paginate(
            $newsRepository, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            7// Nombre de résultats par page
        );

        return $this->render('blog/allNewsOld.html.twig', [
            'controller_name' => 'BlogController',
            'news' => $articles,
            'details' => $detailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/news/{id}  ", name="news")
     */
    public function news($id)
    {

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
    public function formContact(Contact $contact = null, \Swift_Mailer $mailer, Request $request, ObjectManager $manager)
    {
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $repo2 = $this->getDoctrine()->getRepository(Detail::class);
        $details = $repo2->findAll();

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = (new \Swift_Message('Demande de contact de : ' . $contact->getFirstName() . ' ' . $contact->getLastName()))
                ->setTo('contact@mao-bd.com')
                ->setFrom($contact->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/mailContact.html.twig',
                        ['contact' => $contact,
                        ]),
                    'text/html'
                )
            ;

            $mailer->send($message);
            $this->addFlash('add-advertisement', 'Votre annonce à bien été ajouté, vous aller recevoir un mail de confirmation !');
            return $this->redirectToRoute('home');
            return $this->render($message);
        }

        return $this->render('blog/contact.html.twig', [
            'formContact' => $form->createView(),
            'details' => $details,
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
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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
     * @Route("/newSlider/{id}/edit", name="editSlider")
     */
    public function formSlider(Slider $slider = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$slider) {
            $slider = new Slider();
        }
        $form = $this->createForm(SliderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'La modification du slider a bien été prise en compte. ');

            $manager->persist($slider);
            $manager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('blog/createSlider.html.twig', [
            'formSlider' => $form->createView(),
            'editMode' => $slider->getId() !== null,

        ]);
    }

/**
 * @Route("/deleteAlbum/{id}", name="deleteAlbum", methods={"POST"})
 */
    public function deleteAlbum(Request $request)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if ($request->isXmlHttpRequest()) {
            $id = $request->get('entityId');
            $manager = $this->getDoctrine()->getManager();

            $evenement = $manager->getRepository(Albums::class)->find($id);

            $manager->remove($evenement);
            $manager->flush();
            return new JsonResponse('good');
        }

    }

    /**
     * @Route("newAlbum", name="newAlbum")
     * @Route("/albums/{id}/edit", name="editAlbum")
     *
     */
    public function formAlbum(Albums $album = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$album) {
            $album = new Albums();
        }
        $form = $this->createForm(NewAlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Vous venez de publier un nouvel album. ');

            $manager->persist($album);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('blog/createAlbum.html.twig', [
            'controller_name' => 'BlogController',
            'album' => $album,
            'formAlbum' => $form->createView(),
            'editMode' => $album->getId() !== null,
        ]);
    }

    /**
     * @Route("addAlbumImage", name="addAlbumImage")
     */
    public function AddAlbumImage(AlbumImage $albumImage = null, AlbumImageRepository $albumImageRepository, AlbumsRepository $albumsRepository, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$albumImage) {
            $albumImage = new AlbumImage();

        }
        $form = $this->createForm(AlbumImageType::class, $albumImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('saveAndClose')->isClicked()) {
            $this->addFlash('success', 'Vous venez d\'ajouter une ou des images au making-Of. ');

            $manager->persist($albumImage);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }

        if ($form->isSubmitted() && $form->isValid() && $form->get('saveAndAdd')->isClicked()) {
            $this->addFlash('success', 'Vous avez ajouté une photo, vous pouvez en ajouter une autre');
            $manager->persist($albumImage);
            $manager->flush();
            return $this->redirectToRoute('addAlbumImage');
        }

        return $this->render('blog/addMakingOfImage.html.twig', [
            'controller_name' => 'BlogController',
            'makingOfImages' => $albumImageRepository->findAll(),
            'formMakingOfImage' => $form->createView(),
        ]);
    }
/**
 * @Route("/deleteAlbumImage/{id}", name="deleteAlbumImage", methods={"POST"})
 */
    public function deleteImageMakingOf(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $id = $request->get('entityId');
            $manager = $this->getDoctrine()->getManager();

            $evenement = $manager->getRepository(AlbumImage::class)->find($id);

            $manager->remove($evenement);
            $manager->flush();
            return new JsonResponse('good');
        }

    }

    /**
     * @Route("/createNews", name="createNews")
     * @Route("/news/{id}/edit", name="editNews")
     */
    public function createNews(News $news = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$news) {
            $news = new News();
        }
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Vous venez d\'ajouter une news. ');

            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('admin');
        }
        return $this->render('blog/createNews.html.twig', [
            'controller_name' => 'BlogController',
            'formNews' => $form->createView(),
            'editMode' => $news->getId() !== null,
        ]);
    }

    /**
     * @Route("/deleteNews/{id}",  name="deleteNews")
     */
    public function deleteNews($id)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $news = $manager->getRepository(News::class)->find($id);

        if (!$news) {
            throw $this->createNotFoundException(
                'There are no news with the following id: ' . $id
            );
        }

        $manager->remove($news);
        $manager->flush();

        return $this->redirect('/admin');

    }

    /**
     * @Route("/deleteMakingOf/{id}",  name="deleteMakingOf")
     */
    public function deleteMakingOf($id)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $makingOf = $manager->getRepository(MakingOf::class)->find($id);

        if (!$makingOf) {
            throw $this->createNotFoundException(
                'There are no makingOf with the following id: ' . $id
            );
        }

        $manager->remove($makingOf);
        $manager->flush();

        return $this->redirect('/admin');

    }

    /**
     * @Route("/newMakingOf", name="newMakingOf")
     * @Route("/makingOf/{id}/edit", name="editMakingOf")
     */
    public function createMakingOf(MakingOf $makingOf = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$makingOf) {
            $makingOf = new MakingOf();
        }
        $form = $this->createForm(MakingOfType::class, $makingOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Vous venez d\'ajouter un making-Of. ');

            $manager->persist($makingOf);
            $manager->flush();

            return $this->redirectToRoute('addAlbumImage');
        }

        return $this->render('blog/createMakingOf.html.twig', [
            'controller_name' => 'BlogController',
            'formMakingOf' => $form->createView(),
            'editMode' => $makingOf->getId() !== null,
        ]);
    }

    /**
     * @Route("/createDetail", name="createDetail")
     * @Route("/createDetail/{id}/edit", name="editDetail")
     */
    public function createDetail(Detail $detail = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$detail) {
            $detail = new Detail();
        }
        $form = $this->createForm(DetailType::class, $detail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Vous venez de modifier les détails de votre site. ');

            $manager->persist($detail);
            $manager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('blog/createDetail.html.twig', [
            'controller_name' => 'BlogController',
            'formDetail' => $form->createView(),
            'editMode' => $detail->getId() !== null,
        ]);
    }

    /**
     * @Route("/deletePress/{id}",  name="deletePress")
     */
    public function deletePress($id)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $press = $manager->getRepository(Press::class)->find($id);

        if (!$press) {
            throw $this->createNotFoundException(
                'There are no press with the following id: ' . $id
            );
        }

        $manager->remove($press);
        $manager->flush();

        return $this->redirect('/admin');

    }

/**
 * @Route("/createPress", name="createPress")
 * @Route("/createPress/{id}/edit", name="editPress")
 */
    public function formPress(Press $press = null, Request $request, ObjectManager $manager)
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$press) {
            $press = new Press();
        }
        $form = $this->createForm(PressType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Vous venez d\'ajouter une critique presse. ');

            $manager->persist($press);
            $manager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('blog/createPress.html.twig', [
            'controller_name' => 'BlogController',
            'formPress' => $form->createView(),
            'editMode' => $press->getId() !== null,
        ]);
    }
}
