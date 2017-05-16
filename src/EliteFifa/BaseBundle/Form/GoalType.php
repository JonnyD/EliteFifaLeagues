<?php

namespace EliteFifa\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('match', 'entity', array(
                'class' => 'EliteFifaBundle:Match',
                'property' => 'id'
            ))
            ->add('team', 'entity', array(
                'class' => 'EliteFifaBundle:Team',
                'property' => 'name'
            ))
            ->add('player', 'entity', array(
                'class' => 'EliteFifaBundle:Player',
                'property' => 'name'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EliteFifa\Bundle\Entity\Goal',
        ));
    }

    public function getName()
    {
        return 'goal';
    }
}