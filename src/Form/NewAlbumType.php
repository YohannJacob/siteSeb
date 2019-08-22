<?php

namespace App\Form;

use App\Entity\Albums;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('scenario')
            ->add('dessin')
            ->add('Couleur')
            ->add('date')
            ->add('content')
            ->add('cover')
            ->add('buyLink')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('image4')
            ->add('image5')
            ->add('image6')
            ->add('video1')
            ->add('video2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
