<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Validator\Constraints as Assert;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('avatar', Types\FileType::class, [
            'data_class' => null,
            'required' => false,
            'mapped'=>false,
            'constraints' => [
                new Assert\File(["extensions" => ["jpg", "png"], 'mimeTypesMessage' => 'format jpg/png seulement',])
            ]
        ])
            ->add('firstname')
            ->add('lastname')
            ->add('age')
            ->add('birthdate')
            ->add('height')
            ->add('position_favorite')
            ->add('country')
            ->add('number')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
