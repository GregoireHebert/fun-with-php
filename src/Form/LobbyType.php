<?php

namespace App\Form;
use App\Entity\Player;

use App\Entity\Lobby;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LobbyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('name')
        ->add('status',ChoiceType::class, [
            'choices'  => [
                'debutant' => Player::RATIO_DEBUTANT,
                'confirmé' => Player::RATIO_CONFIRME,
                'expert' => Player::RATIO_EXPERT,
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lobby::class,
        ]);
    }
}
