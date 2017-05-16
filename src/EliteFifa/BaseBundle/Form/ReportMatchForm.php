<?php

namespace EliteFifa\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReportMatchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('homeScore')
            ->add('awayScore')
            ->add('goals', 'collection', array(
                'type' => new GoalType(),
                'allow_add'    => true
            ))
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
        return 'report_match';
    }
}