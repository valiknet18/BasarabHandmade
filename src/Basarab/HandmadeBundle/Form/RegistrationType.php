<?php

namespace Basarab\HandmadeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('username', 'text', [
                'label' => 'username',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'first_options' => [
                    'label' => 'Пароль',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                ],
                'second_options' => [
                    'label' => 'Повторіть пароль',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('name', 'text', [
                'label' => 'Ім`я',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('surname', 'text', [
                'label' => 'Прізвище',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('phone', 'text', [
                'label' => 'Номер телефону',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('address', 'text', [
                'label' => 'Адреса',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('description', 'textarea', [
                'label' => 'Опис',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('file', 'file', [
                'label' => 'Аватарка',
                'attr' => [
                    'class' => 'form-control'
                ],
                'data_class' => null
            ])
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'basarab_handmade_registration';
    }
}