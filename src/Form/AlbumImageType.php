<?php

namespace App\Form;

use App\Entity\AlbumImage;
use App\Entity\Albums;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ImageFile', FileType::class, array('data_class' => null, 'label' => 'Image du making-Of'))
            ->add('album', EntityType::class, [
                'class' => Albums::class,
                'choice_label' => 'title',
            ])
            ->add('saveAndClose', SubmitType::class, ['label' => 'Ajouter une photo et fermer',
                'attr' => ['class' => 'btnBlack'],
            ])
            ->add('saveAndAdd', SubmitType::class, ['label' => 'Ajouter une photo et continuer ',
                'attr' => ['class' => 'btnRed'],
            ])
            ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AlbumImage::class,
        ]);
    }
}
