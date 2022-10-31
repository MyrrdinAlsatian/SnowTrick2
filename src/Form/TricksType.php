<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class TricksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('createdAt')
            ->add('updatedAt')
            ->add('images', FileType::class,[
                'multiple' => true,
                'constraints' =>[
                    new All([
                    new File([
                        'maxSize' => '5Mi',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            ],
                        ])
                    ])
                ]
            ])
            ->add('videos', CollectionType::class,[
                'label' => false,
                'entry_type'=> VideoFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype'=>true,
                'prototype_data' => new Video()
            ])
            ->add('category')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
