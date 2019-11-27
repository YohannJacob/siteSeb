<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Slider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ImageFile', FileType::class, array('data_class' => null))
            ->add('Title', TextType::class, ['label' => 'Titre rouge'])
            ->add('SubTitle', TextType::class, ['label' => 'Sous-titre noir'])
            ->add('Position', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                ],
            ])
            ->add('album', EntityType::class, [
                'class' => Albums::class,
                'choice_label' => 'title',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slider::class,
        ]);
    }
}
