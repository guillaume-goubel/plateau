<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Le nom du menu (si vide : 'Menu du jour')",
                'attr' => ['class' => 'form-control', 'maxlength' => 75],
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 75,
                        'maxMessage' => "L'objet ne peut pas dépasser {{ limit }} caractères."
                    ])
                ]
            ])
            ->add('menuForAt', null, [
                'label' => "Date du menu (si vide : Date d'aujourd'hui)",
                'attr' => ['class' => 'form-control'],
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('mainPictureFile', FileType::class, [
                'label' => 'Image principale',
                'label_attr' => [
                    'class' => 'labelCustom'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'image/*' 
                ],
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => 'image/*',
                        'maxSize' => '2M',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
