<?php

namespace Basarab\HandmadeBundle\Form;

use Basarab\HandmadeBundle\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
        ;
    }

    public function getName()
    {
        return 'basarab_handmade_registration';
    }
}