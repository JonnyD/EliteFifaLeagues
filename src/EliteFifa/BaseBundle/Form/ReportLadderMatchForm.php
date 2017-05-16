<?php

namespace EliteFifa\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReportLadderMatchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('homeUser', 'entity', array(
                'class' => 'EliteFifaBundle:User',
                'property' => 'username'
            ))
            ->add('homeTeam', 'entity', array(
                'class' => 'EliteFifaBundle:Team',
                'property' => 'name'
            ))
            ->add('awayUser', 'entity', array(
                'class' => 'EliteFifaBundle:User',
                'property' => 'username'
            ))
            ->add('awayTeam', 'entity', array(
                'class' => 'EliteFifaBundle:Team',
                'property' => 'name'
            ))
            ->add('homeScore')
            ->add('awayScore')
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EliteFifa\Bundle\Entity\Match',
        ));
    }

    public function getName()
    {
        return 'report_ladder_match';
    }
}