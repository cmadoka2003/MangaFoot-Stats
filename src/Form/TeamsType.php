<?php

namespace App\Form;

use App\Entity\Arcs;
use App\Entity\Teams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Validator\Constraints as Assert;

class TeamsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('country')
            ->add('tactics')
            ->add('logo', Types\FileType::class, [
                'data_class' => null,
                'required' => false,
                'mapped'=>false,
                'constraints' => [
                    new Assert\File(["extensions" => ["jpg", "png"], 'mimeTypesMessage' => 'format jpg/png seulement',])
                ]
            ])
            ->add('arcs', EntityType::class, [
                'class' => Arcs::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teams::class,
        ]);
    }
}
