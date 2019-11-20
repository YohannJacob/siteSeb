<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\AlbumImage;
use App\Form\AlbumImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class NewAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coverFile', FileType::class, array('data_class' => null))
            ->add('title', TextType::class, [
                'block_prefix' => 'wrapped_text',
                'block_name' => 'custom_name',
            ])
            ->add('subtitle')
            ->add('scenario')
            ->add('dessin')
            ->add('Couleur')
            ->add('date')
            ->add('content')
            ->add('buyLink')
            ->add('Album_images', CollectionType::class, [
                'entry_type' => AlbumImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}


