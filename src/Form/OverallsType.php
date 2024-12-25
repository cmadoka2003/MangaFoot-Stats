<?php

namespace App\Form;

use App\Entity\Overalls;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OverallsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('total')
            ->add('speed')
            ->add('offense')
            ->add('shoot')
            ->add('dribble')
            ->add('pass')
            ->add('defend')
            ->add('playerId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Overalls::class,
        ]);
    }
}
