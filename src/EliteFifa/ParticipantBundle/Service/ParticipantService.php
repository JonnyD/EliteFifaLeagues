<?php

namespace EliteFifa\ParticipantBundle\Manager;

use Doctrine\ORM\EntityManager;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\ParticiantBundle\Entity\Participant;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\ParticipantBundle\Repository\ParticipantRepository;

class ParticipantService
{
    private $participantRepository;

    public function __construct(ParticipantRepository $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function createParticipant(Team $team, Competition $competition, Season $season)
    {
        $participant = new Participant();
        $participant->setCompetition($competition);
        $participant->setTeam($team);
        $participant->setSeason($season);
        $this->persistAndFlush($participant);
        return $participant;
    }

    public function getAllParticipants()
    {
        return $this->participantRepository->findAll();
    }

    public function getParticipantsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->participantRepository->findBy(
            array(
                'competition' => $competition,
                'season' => $season
            )
        );
    }
}