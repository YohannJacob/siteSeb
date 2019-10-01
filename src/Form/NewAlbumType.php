<?php

namespace App\Form;

use App\Entity\Albums;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NewAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coverFile', VichFileType::class)
            ->add('title')
            ->add('subtitle')
            ->add('scenario')
            ->add('dessin')
            ->add('Couleur')
            ->add('date')
            ->add('content')
            ->add('buyLink')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
