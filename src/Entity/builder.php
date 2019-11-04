<?php

namespace App\Entity;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Knp\Menu\Renderer\ListRenderer;


class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('home', ['route' => '/']);
        $menu->addChild('mesAlbums', ['route' => '/albums']);
        $menu->addChild('biographie', ['route' => '/biographie']);
        $menu->addChild('allNews', ['route' => '/allNews']);
        $menu->addChild('allMakingOf', ['route' => '/allMakingOf']);
        $menu->addChild('contact', ['route' => '/contact']);

        

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
    
        return $menu;
    }
}