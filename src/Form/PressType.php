<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Press;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('journal', TextType::class, ['label' => 'Nom du journal'])
            ->add('ImageFile', FileType::class, array('data_class' => null))
            ->add('content', TextType::class, ['label' => 'Extrait presse'])
            ->add('album', EntityType::class, [
                'class' => Albums::class,
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Press::class,
        ]);
    }
}
