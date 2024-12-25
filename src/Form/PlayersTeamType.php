<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\PlayersTeam;
use App\Entity\Teams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayersTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerPosition')
            ->add('actif')
            ->add('teamId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'id',
            ])
            ->add('playerId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayersTeam::class,
        ]);
    }
}
