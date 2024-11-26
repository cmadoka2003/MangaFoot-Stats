<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST')
            ->add('email', Types\EmailType::class, [
                'constraints' => [new Assert\NotBlank(["message" => "vous devez remplir l'adresse mail"])]
            ])
            ->add('pseudo', Types\TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(["message" => "vous devez remplir le pseudo"]),
                    new Assert\Length(["min" => 3, "max" => 50, "minMessage" => "pseudo trop court", "maxMessage" => "pseudo trop long"])
                ]
            ])
            ->add('password', Types\RepeatedType::class, [
                'type' => Types\PasswordType::class,
                'invalid_message' => 'les mots de passes ne sont pas identiques',
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'confirmPassword'],
                'constraints' => [
                    new Assert\NotBlank(["message" => "vous devez remplir le mot de passe"]),
                    new Assert\Length(["min" => 6, "max" => 50, "minMessage" => "mot de passe trop court", "maxMessage" => "mot de passe trop long"])
                ]
            ])
            ->add('Inscription', Types\SubmitType::class);

        $builder->get('email')->setRequired(false);
        $builder->get('password')->setRequired(false);
        $builder->get('pseudo')->setRequired(false);
    }
}