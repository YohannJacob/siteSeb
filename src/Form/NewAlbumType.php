<?php

namespace App\Form;

use App\Entity\Albums;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coverFile', FileType::class, array('data_class' => null, 'label' => 'Image couverture'))
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('subtitle', TextType::class, ['label' => 'Sous-titre'])
            ->add('scenario', TextType::class, ['label' => 'Scenariste'])
            ->add('dessin', TextType::class, ['label' => 'Dessinateur'])
            ->add('Couleur', TextType::class, ['label' => 'Coloriste'])
            ->add('date', TextType::class, ['label' => 'Date de publication'])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'tinymce', 'label' => 'Texte de présentation'],

            ])
            ->add('buyLink', TextType::class, ['label' => 'Lien de vente bamboo'])
            ->add('image1File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image2File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image3File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image4File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image5File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image6File', FileType::class, array('data_class' => null, 'required' => false))
            ->add('image7File', FileType::class, array('data_class' => null, 'required' => false))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
