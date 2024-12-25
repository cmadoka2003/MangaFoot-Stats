<?php

namespace App\Form;

use App\Entity\Arcs;
use App\Entity\GoalsAssists;
use App\Entity\Matchs;
use App\Entity\Player;
use App\Entity\Teams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoalsAssistsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matchId', EntityType::class, [
                'class' => Matchs::class,
'choice_label' => 'id',
            ])
            ->add('teamId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'name',
            ])
            ->add('goalId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'lastname',
            ])
            ->add('assistId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'lastname',
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
            'data_class' => GoalsAssists::class,
        ]);
    }
}
