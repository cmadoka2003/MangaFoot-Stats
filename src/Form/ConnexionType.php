<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Validator\Constraints as Assert;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST')
            ->add('email', Types\EmailType::class, [
                'constraints' => [new Assert\NotBlank(["message" => "vous devez remplir l'adresse mail"])]
            ])
            ->add('password', Types\PasswordType::class , [
                'constraints' => [
                    new Assert\NotBlank(["message" => "vous devez remplir le mot de passe"]),
                    new Assert\Length(["min" => 6, "max" => 50, "minMessage" => "mot de passe trop court", "maxMessage" => "mot de passe trop long"])
                ]
            ])
            ->add('Connexion', Types\SubmitType::class);

        $builder->get('email')->setRequired(false);
        $builder->get('password')->setRequired(false);
    }
}
