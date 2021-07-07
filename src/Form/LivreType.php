<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, [
                "label" => "Titre du livre",
                "help" => "Le titre du livre doit compter entre 4 et 5O caractéres",
                "constraints" => [
                    new Length([
                        "min" => 4,
                        "minMessage" => "le titre doit avoir au moins 4 caractères",
                        "max" => 50,
                        "maxMessage" =>"le titre ne peut pas dépasser 50 caractères"
                    ])
                ]
            ])
            ->add('auteur',TextType::class, [
                "attr" => [ "class" => "bg-secondary" ],
                "constraints" => [
                    new NotBlank([
                        "message" => "L'auteur ne peut être vide"
                    ])
                ],
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}

