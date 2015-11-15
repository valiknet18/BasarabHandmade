<?php

namespace Basarab\HandmadeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
        ;

        $builder
            ->add('username', 'text')
        ;

        $builder
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'first_options' => array('label' => 'Пароль'),
                'second_options' => array('label' => 'Повторіть пароль'),
            ])
        ;

        $builder
            ->add('name', 'text', [
                'label' => 'Ім`я'
            ])
        ;

        $builder
            ->add('surname', 'text', [
                'label' => 'Прізвище'
            ])
        ;

        $builder
            ->add('phone', 'text', [
                'label' => 'Номер телефону'
            ])
        ;

        $builder
            ->add('address', 'text', [
                'label' => 'Адреса'
            ])
        ;

        $builder
            ->add('description', 'textarea', [
                'label' => 'Опис'
            ])
        ;

        $builder
            ->add('avatar', 'file', [
                'label' => 'Аватарка',
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