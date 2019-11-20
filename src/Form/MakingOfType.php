<?php

namespace App\Form;

use App\Entity\MakingOf;
use App\Entity\Albums;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class MakingOfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Content', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
 
                )))

            ->add('album', EntityType::class,[
                'class' => Albums::class,
                'choice_label' => 'title',
            ])   ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MakingOf::class,
        ]);
    }
}
