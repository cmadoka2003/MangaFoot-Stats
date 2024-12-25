<?php

namespace App\Form;

use App\Entity\Favorite;
use App\Entity\Player;
use App\Entity\Teams;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FavoriteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerId', EntityType::class, [
                'class' => Player::class,
'choice_label' => 'id',
            ])
            ->add('teamId', EntityType::class, [
                'class' => Teams::class,
'choice_label' => 'id',
            ])
            ->add('userId', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Favorite::class,
        ]);
    }
}
