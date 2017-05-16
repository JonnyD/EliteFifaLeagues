<?php

namespace EliteFifa\CompetitionBundle\Form;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\SeasonBundle\Entity\Season;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectRoundForm extends AbstractType
{
    /**
     * @var Round[]
     */
    private $rounds;

    /**
     * @var int $currentRound
     */
    private $currentRound;

    /**
     * @param Round[] $rounds
     * @param int $currentRound
     */
    public function __construct(array $rounds, $currentRound)
    {
        $this->rounds = $rounds;
        $this->currentRound = $currentRound;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [];
        foreach ($this->rounds as $round) {
            $choices[$round->getId()] = $round->getRound();
        }

        $builder
            ->add('select_round', 'choice', [
                'choices' => $choices,
                'label' => 'Round ',
                'data' => $this->currentRound
            ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'select_round';
    }
}