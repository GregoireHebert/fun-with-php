<?php

namespace App\Form;

use App\Entity\Match;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('scorePlayerA', null, ['required' => false])
            ->add('scorePlayerB', null, ['required' => false])
            ->add('status',ChoiceType::class, [
                'choices'  => [
                    'En attente' => Match::STATUS_PENDING,
                    'En cours' => Match::STATUS_PLAYING,
                    'Terminé' => Match::STATUS_OVER,
                ],
            ])
            ->add('playerA', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'username'
            ])
            ->add('playerB', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'username'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class,
        ]);
    }
}
