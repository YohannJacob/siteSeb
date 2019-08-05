<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Albums;

class BlogController extends AbstractController
{
    // Route en front

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }


    /**
     * @Route("/mesAlbums", name="mesAlbums")
     */
    public function mesAlbums()
    {
        $repo = $this->getDoctrine()->getRepository(Albums::class);
        $albums = $repo->findAll();

        return $this->render('blog/mesalbums.html.twig',[
            'controller_name' => 'BlogController',
            "albums"=>$albums,
        ]);
    }

    /**
     * @Route("/album/12", name="album")
     */
    public function album()
    {
        return $this->render('blog/album.html.twig');
    }

    /**
     * @Route("/aPropos", name="aPropos")
     */
    public function aPropos()
    {
        return $this->render('blog/apropos.html.twig');
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
     * @Route("/createAlbum", name="createAlbum")
     */
    public function createAlbum()
    {
        return $this->render('blog/createAlbum.html.twig');
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
