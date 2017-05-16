<?php

namespace EliteFifa\SeasonBundle\Service;

use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\SeasonBundle\Repository\SeasonRepository;
use EliteFifa\SeasonBundle\Entity\Season;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;

class SeasonService
{
    /**
     * @var SeasonRepository
     */
    private $seasonRepository;
    private $formFactory;

    public function __construct(SeasonRepository $seasonRepository,
                                FormFactory $formFactory)
    {
        $this->seasonRepository = $seasonRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @param int $id
     * @return Season
     */
    public function getSeasonById(int $id)
    {
        return $this->seasonRepository->find($id);
    }

    /**
     * @param int $number
     * @return Season
     */
    public function getSeasonByNumber(int $number)
    {
        return $this->seasonRepository->findOneByNumber($number);
    }

    public function createSeason($startDate, $endDate)
    {
        $season = new Season();
        $season->setStartDate($startDate);
        $season->setEndDate($endDate);
        return $season;
    }

    public function createSeasonForLadder($league)
    {
        $startDate = new \DateTime('first day of this month 00:00:00');
        $endDate = new \DateTime('last day of this month 23:59:59');
        $season = $this->createSeason($startDate, $endDate);
        return $season;
    }

    public function getSeasonsByCompetition($competition)
    {
        return $this->seasonRepository->findSeasonsByCompetition($competition);
    }

    public function getCurrentSeasonForLeague($league)
    {
        return $this->seasonRepository->findCurrentSeasonForLeague($league);
    }

    public function getLatestSeasonForCompetition($competition)
    {
        return $this->seasonRepository->findLatestSeasonForCompetition($competition);
    }

    /**
     * @param Association $association
     * @return Season
     */
    public function getLatestSeasonByAssociation(Association $association)
    {
        return $this->seasonRepository->findLatestSeasonByAssociation($association);
    }

    public function getLatestOrSpecifiedSeasonForCompetition(Competition $competition, $number)
    {
        $season = null;
        if ($number != null) {
            $season = $this->getSeasonByCompetitionAndNumber($competition, $number);
        } else {
            $season = $this->getLatestSeasonForCompetition($competition);
        }
        return $season;
    }

    public function getSeasonByCompetitionAndNumber($competition, $number)
    {
        return $this->seasonRepository->findSeasonByCompetitionAndNumber($competition, $number);
    }

    public function getSeasonByAssociationAndNumber(Association $association, $number)
    {
        return $this->seasonRepository->findOneBy(
            array(
                'association' => $association,
                'number' => $number
            )
        );
    }

    public function getSeasonChoicesForDropDownByCompetition($competition)
    {
        $seasons = $this->getSeasonsByCompetition($competition);
        $seasonChoices = array();
        foreach ($seasons as $season) {
            $number = $season->getNumber();
            $seasonChoices[$number] = $number;
        }
        return $seasonChoices;
    }

    public function createSelectSeasonDropDown(Competition $competition, $action, $currentSeason)
    {
        $seasonChoices = $this->getSeasonChoicesForDropDownByCompetition($competition);
        $selectSeasonForm = $this->formFactory->createBuilder()
            ->setAction($action)
            ->setMethod("GET")
            ->add('select_season', 'choice', array(
                'choices' => $seasonChoices,
                'label' => false,
                'data' => $currentSeason->getNumber()
            ))
            ->getForm();
        return $selectSeasonForm;
    }

    public function getSeasonByCompetitionAndDate($competition, $date)
    {
        return $this->seasonRepository->findSeasonByCompetitionAndDate($competition, $date);
    }

    /**
     * @param Season $season
     * @param bool $sync
     */
    public function save(Season $season, bool $sync = true)
    {
        $this->seasonRepository->save($season, $sync);
    }
}