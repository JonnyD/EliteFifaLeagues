<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Participant;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Competition\CompetitionFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Season\SeasonFixtures;
use EliteFifa\ParticipantBundle\Entity\Participant;
use EliteFifa\TeamBundle\DataFixtures\ORM\Team\TeamFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParticipantFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
    private $manager;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $worldLeague1 = $this->getReference('competition.elite-league-1');
        $worldSeason1 = $this->getReference('season.season-1');

        $participant1 = $this->createParticipant("Liverpool", $worldLeague1, $worldSeason1);
        $participant2 = $this->createParticipant("Real Madrid", $worldLeague1, $worldSeason1);
        $participant3 = $this->createParticipant("Borussia Dortmund", $worldLeague1, $worldSeason1);
        $participant4 = $this->createParticipant("Chelsea", $worldLeague1, $worldSeason1);
        $participant5 = $this->createParticipant("Barcelona", $worldLeague1, $worldSeason1);
        $participant6 = $this->createParticipant("Arsenal", $worldLeague1, $worldSeason1);
        $participant7 = $this->createParticipant("Manchester United", $worldLeague1, $worldSeason1);
        $participant8 = $this->createParticipant("Bayern Munich", $worldLeague1, $worldSeason1);
        $participant9 = $this->createParticipant("Milan", $worldLeague1, $worldSeason1);
        $participant10 = $this->createParticipant("Athletico Madrid", $worldLeague1, $worldSeason1);
        $participant11 = $this->createParticipant("Tottenham Hotspur", $worldLeague1, $worldSeason1);
        $participant12 = $this->createParticipant("Roma", $worldLeague1, $worldSeason1);

        $this->createReference($participant1, 1);
        $this->createReference($participant1, 2);
        $this->createReference($participant1, 3);
        $this->createReference($participant1, 4);
        $this->createReference($participant1, 5);
        $this->createReference($participant1, 6);
        $this->createReference($participant1, 7);
        $this->createReference($participant1, 8);
        $this->createReference($participant1, 9);
        $this->createReference($participant1, 10);
        $this->createReference($participant1, 11);
        $this->createReference($participant1, 12);

        $manager->flush();
    }

    /**
     * @param $teamName
     * @param $competition
     * @param $season
     * @return Participant
     */
    private function createParticipant($teamName, $competition, $season)
    {
        $team = $this->getReference('team.'.$teamName);

        $participant = new Participant();
        $participant->setCompetition($competition);
        $participant->setTeam($team);
        $participant->setSeason($season);

        $this->manager->persist($participant);
        return $participant;
    }

    /**
     * @param $participant
     * @param $i
     */
    private function createReference($participant, $i)
    {
        $season = $participant->getSeason();
        $competition = $participant->getCompetition();

        $this->addReference('participant.competition.'
            .$competition->getAssociation()->getSlug().'-'
            .$competition->getDivision().'.'
            .'season-'.'-'.$i, $participant);
    }

    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            SeasonFixtures::class,
            CompetitionFixtures::class
        ];
    }
}