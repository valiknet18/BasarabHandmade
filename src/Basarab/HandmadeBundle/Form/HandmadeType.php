<?php

namespace Basarab\HandmadeBundle\Form;

use Basarab\HandmadeBundle\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HandmadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StringToArrayTransformer();

        $builder
            ->add('uploadedFiles', 'file', [
                'multiple' => true
            ])
            ->add('name', 'text', [
                'label' => 'Назва',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('text', 'textarea', [
                'label' => 'Опис',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add(
                $builder->create('tag', 'text', [
                        "mapped" => false,
                        'label' => 'Теги',
                        'attr' => [
                            'class' => 'form-control',
                        ]
                    ]
                )
                ->addModelTransformer($transformer)
            )
        ;
    }

    public function getName()
    {
        return 'basarab_handmade_handmade';
    }
}