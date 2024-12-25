<?php

namespace App\Form;

use App\Entity\Arcs;
use App\Entity\Matchs;
use App\Entity\Teams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('teamHomeScore')
            ->add('teamAwayScore')
            ->add('arcs', EntityType::class, [
                'class' => Arcs::class,
'choice_label' => 'id',
            ])
            ->add('teamHomeId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'id',
            ])
            ->add('teamAwayId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
