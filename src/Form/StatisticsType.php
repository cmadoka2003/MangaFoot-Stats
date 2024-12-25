<?php

namespace App\Form;

use App\Entity\Arcs;
use App\Entity\Matchs;
use App\Entity\Player;
use App\Entity\Statistics;
use App\Entity\Teams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('goalkeeper')
            ->add('shotsOnTarget')
            ->add('shotsOffTarget')
            ->add('blockedShots')
            ->add('touches')
            ->add('passAttempts')
            ->add('sussessfulPasses')
            ->add('dribbleAttempts')
            ->add('sussessfulDribbles')
            ->add('crosseAttempts')
            ->add('sussessfulCrosses')
            ->add('tackleAttempts')
            ->add('sussessfulTackles')
            ->add('aerialDuels')
            ->add('possessionLost')
            ->add('clearences')
            ->add('interceptions')
            ->add('dribbledPast')
            ->add('fouls')
            ->add('yellowCards')
            ->add('redCards')
            ->add('punches')
            ->add('saves')
            ->add('savesFromInsideBox')
            ->add('goalConceded')
            ->add('matchId', EntityType::class, [
                'class' => Matchs::class,
'choice_label' => 'id',
            ])
            ->add('playerId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'id',
            ])
            ->add('teamId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'id',
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
            'data_class' => Statistics::class,
        ]);
    }
}
