<?php

namespace EliteFifa\MatchBundle\DataFixtures\ORM\Match;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\DataFixtures\ORM\Competitor\CompetitorFixtures;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\DataFixtures\ORM\User\UserFixtures;
use EliteFifa\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MatchFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
    private $manager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createEliteLeague1Season1Matches();
        $this->createEliteLeague2Season1Matches();
        $this->createSuperLeague1Season1Matches();
        $this->createSuperLeague2Season1Matches();
    }

    private function createEliteLeague1Season1Matches()
    {
        $worldLeague1 = $this->getCompetition('elite-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');

        $round = $this->createRound(new \DateTime('2014-01-01'), 1);
        $reported = new \DateTime('2014-01-01');
        $confirmed = new \DateTime('2014-01-01');
        $match1 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor3, $competitor5,
            $competitor3->getTeam(), $competitor5->getTeam(),
            $competitor3->getUser(), $competitor5->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match2 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor2, $competitor1,
            $competitor2->getTeam(), $competitor1->getTeam(),
            $competitor2->getUser(), $competitor1->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-03'), 2);
        $reported = new \DateTime('2014-01-03');
        $confirmed = new \DateTime('2014-01-03');
        $match3 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor4, $competitor2,
            $competitor4->getTeam(), $competitor2->getTeam(),
            $competitor4->getUser(), $competitor2->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);
        $match4 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor1, $competitor3,
            $competitor1->getTeam(), $competitor3->getTeam(),
            $competitor1->getUser(), $competitor3->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-05'), 3);
        $reported = new \DateTime('2014-01-05');
        $confirmed = new \DateTime('2014-01-05');
        $match5 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor5, $competitor1,
            $competitor5->getTeam(), $competitor1->getTeam(),
            $competitor5->getUser(), $competitor1->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match6 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor3, $competitor4,
            $competitor3->getTeam(), $competitor4->getTeam(),
            $competitor3->getUser(), $competitor4->getUser(),
            1, 3,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-07'), 4);
        $reported = new \DateTime('2014-01-07');
        $confirmed = new \DateTime('2014-01-07');
        $match7 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor2, $competitor3,
            $competitor2->getTeam(), $competitor3->getTeam(),
            $competitor2->getUser(), $competitor3->getUser(),
            4, 4,
            $reported, $confirmed,
            $round);
        $match8 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor4, $competitor5,
            $competitor4->getTeam(), $competitor5->getTeam(),
            $competitor4->getUser(), $competitor5->getUser(),
            0, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-09'), 5);
        $reported = new \DateTime('2014-01-09');
        $confirmed = new \DateTime('2014-01-09');
        $match9 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor1, $competitor4,
            $competitor1->getTeam(), $competitor4->getTeam(),
            $competitor1->getUser(), $competitor4->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);
        $match10 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor5, $competitor2,
            $competitor5->getTeam(), $competitor2->getTeam(),
            $competitor5->getUser(), $competitor2->getUser(),
            2, 0,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-11'), 6);
        $reported = new \DateTime('2014-01-11');
        $confirmed = new \DateTime('2014-01-11');
        $match11 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor5, $competitor3,
            $competitor5->getTeam(), $competitor3->getTeam(),
            $competitor5->getUser(), $competitor3->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match12 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor1, $competitor2,
            $competitor1->getTeam(), $competitor2->getTeam(),
            $competitor1->getUser(), $competitor2->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-13'), 7);
        $reported = new \DateTime('2014-01-13');
        $confirmed = new \DateTime('2014-01-13');
        $match13 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor2, $competitor4,
            $competitor2->getTeam(), $competitor4->getTeam(),
            $competitor2->getUser(), $competitor4->getUser(),
            0, 0,
            $reported, $confirmed,
            $round);
        $match14 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor3, $competitor1,
            $competitor3->getTeam(), $competitor1->getTeam(),
            $competitor3->getUser(), $competitor1->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-15'), 8);
        $reported = new \DateTime('2014-01-15');
        $confirmed = new \DateTime('2014-01-15');
        $match15 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor1, $competitor5,
            $competitor1->getTeam(), $competitor5->getTeam(),
            $competitor1->getUser(), $competitor5->getUser(),
            1, 2,
            $reported, $confirmed,
            $round);
        $match16 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor4, $competitor3,
            $competitor4->getTeam(), $competitor3->getTeam(),
            $competitor4->getUser(), $competitor3->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-17'), 9);
        $reported = new \DateTime('2014-01-17');
        $confirmed = new \DateTime('2014-01-17');
        $match17 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor3, $competitor2,
            $competitor3->getTeam(), $competitor2->getTeam(),
            $competitor3->getUser(), $competitor2->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);
        $match18 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor5, $competitor4,
            $competitor5->getTeam(), $competitor4->getTeam(),
            $competitor5->getUser(), $competitor4->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-19'), 10);
        $reported = new \DateTime('2014-01-19');
        $confirmed = new \DateTime('2014-01-19');
        $match19 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor4, $competitor1,
            $competitor4->getTeam(), $competitor1->getTeam(),
            $competitor4->getUser(), $competitor1->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match20 = $this->createMatch(
            $worldLeague1, $worldSeason1,
            $competitor2, $competitor5,
            $competitor2->getTeam(), $competitor5->getTeam(),
            $competitor2->getUser(), $competitor5->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $this->manager->persist($match1);
        $this->manager->persist($match2);
        $this->manager->persist($match3);
        $this->manager->persist($match4);
        $this->manager->persist($match5);
        $this->manager->persist($match6);
        $this->manager->persist($match7);
        $this->manager->persist($match8);
        $this->manager->persist($match9);
        $this->manager->persist($match10);
        $this->manager->persist($match11);
        $this->manager->persist($match12);
        $this->manager->persist($match13);
        $this->manager->persist($match14);
        $this->manager->persist($match15);
        $this->manager->persist($match16);
        $this->manager->persist($match17);
        $this->manager->persist($match18);
        $this->manager->persist($match19);
        $this->manager->persist($match20);

        $this->manager->flush();
    }

    private function createEliteLeague2Season1Matches()
    {
        $eliteLeague2 = $this->getCompetition('elite-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitor6 = $this->getCompetitor('competitor6');
        $competitor7 = $this->getCompetitor('competitor7');
        $competitor8 = $this->getCompetitor('competitor8');
        $competitor9 = $this->getCompetitor('competitor9');
        $competitor10 = $this->getCompetitor('competitor10');

        $round = $this->createRound(new \DateTime('2014-01-01'), 1);
        $reported = new \DateTime('2014-01-01');
        $confirmed = new \DateTime('2014-01-01');
        $match1 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor8, $competitor10,
            $competitor8->getTeam(), $competitor10->getTeam(),
            $competitor8->getUser(), $competitor10->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match2 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor9, $competitor6,
            $competitor9->getTeam(), $competitor6->getTeam(),
            $competitor9->getUser(), $competitor6->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-03'), 2);
        $reported = new \DateTime('2014-01-03');
        $confirmed = new \DateTime('2014-01-03');
        $match3 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor7, $competitor9,
            $competitor7->getTeam(), $competitor9->getTeam(),
            $competitor7->getUser(), $competitor9->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match4 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor6, $competitor8,
            $competitor6->getTeam(), $competitor8->getTeam(),
            $competitor6->getUser(), $competitor8->getUser(),
            2, 4,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-05'), 3);
        $reported = new \DateTime('2014-01-05');
        $confirmed = new \DateTime('2014-01-05');
        $match5 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor10, $competitor6,
            $competitor10->getTeam(), $competitor6->getTeam(),
            $competitor10->getUser(), $competitor6->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);
        $match6 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor8, $competitor7,
            $competitor8->getTeam(), $competitor7->getTeam(),
            $competitor8->getUser(), $competitor7->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-07'), 4);
        $reported = new \DateTime('2014-01-07');
        $confirmed = new \DateTime('2014-01-07');
        $match7 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor9, $competitor8,
            $competitor9->getTeam(), $competitor8->getTeam(),
            $competitor9->getUser(), $competitor8->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);
        $match8 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor7, $competitor10,
            $competitor7->getTeam(), $competitor10->getTeam(),
            $competitor7->getUser(), $competitor10->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-09'), 5);
        $reported = new \DateTime('2014-01-09');
        $confirmed = new \DateTime('2014-01-09');
        $match9 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor6, $competitor7,
            $competitor6->getTeam(), $competitor7->getTeam(),
            $competitor6->getUser(), $competitor7->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match10 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor10, $competitor9,
            $competitor10->getTeam(), $competitor9->getTeam(),
            $competitor10->getUser(), $competitor9->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-11'), 6);
        $reported = new \DateTime('2014-01-11');
        $confirmed = new \DateTime('2014-01-11');
        $match11 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor10, $competitor8,
            $competitor10->getTeam(), $competitor8->getTeam(),
            $competitor10->getUser(), $competitor8->getUser(),
            3, 3,
            $reported, $confirmed,
            $round);
        $match12 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor6, $competitor9,
            $competitor6->getTeam(), $competitor9->getTeam(),
            $competitor6->getUser(), $competitor9->getUser(),
            4, 3,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-13'), 7);
        $reported = new \DateTime('2014-01-13');
        $confirmed = new \DateTime('2014-01-13');
        $match13 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor9, $competitor7,
            $competitor9->getTeam(), $competitor7->getTeam(),
            $competitor9->getUser(), $competitor7->getUser(),
            2, 3,
            $reported, $confirmed,
            $round);
        $match14 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor8, $competitor6,
            $competitor8->getTeam(), $competitor6->getTeam(),
            $competitor8->getUser(), $competitor6->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-15'), 8);
        $reported = new \DateTime('2014-01-15');
        $confirmed = new \DateTime('2014-01-15');
        $match15 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor6, $competitor10,
            $competitor6->getTeam(), $competitor10->getTeam(),
            $competitor6->getUser(), $competitor10->getUser(),
            0, 0,
            $reported, $confirmed,
            $round);
        $match16 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor7, $competitor8,
            $competitor7->getTeam(), $competitor8->getTeam(),
            $competitor7->getUser(), $competitor8->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-17'), 9);
        $reported = new \DateTime('2014-01-17');
        $confirmed = new \DateTime('2014-01-17');
        $match17 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor8, $competitor9,
            $competitor8->getTeam(), $competitor9->getTeam(),
            $competitor8->getUser(), $competitor9->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match18 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor10, $competitor7,
            $competitor10->getTeam(), $competitor7->getTeam(),
            $competitor10->getUser(), $competitor7->getUser(),
            4, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-19'), 10);
        $reported = new \DateTime('2014-01-19');
        $confirmed = new \DateTime('2014-01-19');
        $match19 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor7, $competitor6,
            $competitor7->getTeam(), $competitor6->getTeam(),
            $competitor7->getUser(), $competitor6->getUser(),
            5, 1,
            $reported, $confirmed,
            $round);
        $match20 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor9, $competitor10,
            $competitor9->getTeam(), $competitor10->getTeam(),
            $competitor9->getUser(), $competitor10->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $this->manager->persist($match1);
        $this->manager->persist($match2);
        $this->manager->persist($match3);
        $this->manager->persist($match4);
        $this->manager->persist($match5);
        $this->manager->persist($match6);
        $this->manager->persist($match7);
        $this->manager->persist($match8);
        $this->manager->persist($match9);
        $this->manager->persist($match10);
        $this->manager->persist($match11);
        $this->manager->persist($match12);
        $this->manager->persist($match13);
        $this->manager->persist($match14);
        $this->manager->persist($match15);
        $this->manager->persist($match16);
        $this->manager->persist($match17);
        $this->manager->persist($match18);
        $this->manager->persist($match19);
        $this->manager->persist($match20);

        $this->manager->flush();
    }

    private function createSuperLeague1Season1Matches()
    {
        $eliteLeague2 = $this->getCompetition('super-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitor11 = $this->getCompetitor('competitor11');
        $competitor12 = $this->getCompetitor('competitor12');
        $competitor13 = $this->getCompetitor('competitor13');
        $competitor14 = $this->getCompetitor('competitor14');
        $competitor15 = $this->getCompetitor('competitor15');

        $round = $this->createRound(new \DateTime('2014-01-01'), 1);
        $reported = new \DateTime('2014-01-01');
        $confirmed = new \DateTime('2014-01-01');
        $match1 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor13, $competitor15,
            $competitor13->getTeam(), $competitor15->getTeam(),
            $competitor13->getUser(), $competitor15->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match2 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor14, $competitor11,
            $competitor14->getTeam(), $competitor11->getTeam(),
            $competitor14->getUser(), $competitor11->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-03'), 2);
        $reported = new \DateTime('2014-01-03');
        $confirmed = new \DateTime('2014-01-03');
        $match3 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor12, $competitor14,
            $competitor12->getTeam(), $competitor14->getTeam(),
            $competitor12->getUser(), $competitor14->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match4 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor11, $competitor13,
            $competitor11->getTeam(), $competitor13->getTeam(),
            $competitor11->getUser(), $competitor13->getUser(),
            2, 4,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-05'), 3);
        $reported = new \DateTime('2014-01-05');
        $confirmed = new \DateTime('2014-01-05');
        $match5 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor15, $competitor11,
            $competitor15->getTeam(), $competitor11->getTeam(),
            $competitor15->getUser(), $competitor11->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);
        $match6 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor13, $competitor12,
            $competitor13->getTeam(), $competitor12->getTeam(),
            $competitor13->getUser(), $competitor12->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-07'), 4);
        $reported = new \DateTime('2014-01-07');
        $confirmed = new \DateTime('2014-01-07');
        $match7 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor14, $competitor13,
            $competitor14->getTeam(), $competitor13->getTeam(),
            $competitor14->getUser(), $competitor13->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);
        $match8 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor12, $competitor15,
            $competitor12->getTeam(), $competitor15->getTeam(),
            $competitor12->getUser(), $competitor15->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-09'), 5);
        $reported = new \DateTime('2014-01-09');
        $confirmed = new \DateTime('2014-01-09');
        $match9 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor11, $competitor12,
            $competitor11->getTeam(), $competitor12->getTeam(),
            $competitor11->getUser(), $competitor12->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match10 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor15, $competitor14,
            $competitor15->getTeam(), $competitor14->getTeam(),
            $competitor15->getUser(), $competitor14->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-11'), 6);
        $reported = new \DateTime('2014-01-11');
        $confirmed = new \DateTime('2014-01-11');
        $match11 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor15, $competitor13,
            $competitor15->getTeam(), $competitor13->getTeam(),
            $competitor15->getUser(), $competitor13->getUser(),
            3, 3,
            $reported, $confirmed,
            $round);
        $match12 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor11, $competitor14,
            $competitor11->getTeam(), $competitor14->getTeam(),
            $competitor11->getUser(), $competitor14->getUser(),
            4, 3,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-13'), 7);
        $reported = new \DateTime('2014-01-13');
        $confirmed = new \DateTime('2014-01-13');
        $match13 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor14, $competitor12,
            $competitor14->getTeam(), $competitor12->getTeam(),
            $competitor14->getUser(), $competitor12->getUser(),
            2, 3,
            $reported, $confirmed,
            $round);
        $match14 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor13, $competitor11,
            $competitor13->getTeam(), $competitor11->getTeam(),
            $competitor13->getUser(), $competitor11->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-15'), 8);
        $reported = new \DateTime('2014-01-15');
        $confirmed = new \DateTime('2014-01-15');
        $match15 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor11, $competitor15,
            $competitor11->getTeam(), $competitor15->getTeam(),
            $competitor11->getUser(), $competitor15->getUser(),
            0, 0,
            $reported, $confirmed,
            $round);
        $match16 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor12, $competitor13,
            $competitor12->getTeam(), $competitor13->getTeam(),
            $competitor12->getUser(), $competitor13->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-17'), 9);
        $reported = new \DateTime('2014-01-17');
        $confirmed = new \DateTime('2014-01-17');
        $match17 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor13, $competitor14,
            $competitor13->getTeam(), $competitor14->getTeam(),
            $competitor13->getUser(), $competitor14->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match18 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor15, $competitor12,
            $competitor15->getTeam(), $competitor12->getTeam(),
            $competitor15->getUser(), $competitor12->getUser(),
            4, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-19'), 10);
        $reported = new \DateTime('2014-01-19');
        $confirmed = new \DateTime('2014-01-19');
        $match19 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor12, $competitor11,
            $competitor12->getTeam(), $competitor11->getTeam(),
            $competitor12->getUser(), $competitor11->getUser(),
            5, 1,
            $reported, $confirmed,
            $round);
        $match20 = $this->createMatch(
            $eliteLeague2, $worldSeason1,
            $competitor14, $competitor15,
            $competitor14->getTeam(), $competitor15->getTeam(),
            $competitor14->getUser(), $competitor15->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $this->manager->persist($match1);
        $this->manager->persist($match2);
        $this->manager->persist($match3);
        $this->manager->persist($match4);
        $this->manager->persist($match5);
        $this->manager->persist($match6);
        $this->manager->persist($match7);
        $this->manager->persist($match8);
        $this->manager->persist($match9);
        $this->manager->persist($match10);
        $this->manager->persist($match11);
        $this->manager->persist($match12);
        $this->manager->persist($match13);
        $this->manager->persist($match14);
        $this->manager->persist($match15);
        $this->manager->persist($match16);
        $this->manager->persist($match17);
        $this->manager->persist($match18);
        $this->manager->persist($match19);
        $this->manager->persist($match20);

        $this->manager->flush();
    }

    private function createSuperLeague2Season1Matches()
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $worldSeason1 = $this->getSeason('season-1');

        $competitor16 = $this->getCompetitor('competitor16');
        $competitor17 = $this->getCompetitor('competitor17');
        $competitor18 = $this->getCompetitor('competitor18');
        $competitor19 = $this->getCompetitor('competitor19');
        $competitor20 = $this->getCompetitor('competitor20');

        $round = $this->createRound(new \DateTime('2014-01-01'), 1);
        $reported = new \DateTime('2014-01-01');
        $confirmed = new \DateTime('2014-01-01');
        $match1 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor18, $competitor20,
            $competitor18->getTeam(), $competitor20->getTeam(),
            $competitor18->getUser(), $competitor20->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match2 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor19, $competitor16,
            $competitor19->getTeam(), $competitor16->getTeam(),
            $competitor19->getUser(), $competitor16->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-03'), 2);
        $reported = new \DateTime('2014-01-03');
        $confirmed = new \DateTime('2014-01-03');
        $match3 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor17, $competitor19,
            $competitor17->getTeam(), $competitor19->getTeam(),
            $competitor17->getUser(), $competitor19->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match4 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor16, $competitor18,
            $competitor16->getTeam(), $competitor18->getTeam(),
            $competitor16->getUser(), $competitor18->getUser(),
            2, 4,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-05'), 3);
        $reported = new \DateTime('2014-01-05');
        $confirmed = new \DateTime('2014-01-05');
        $match5 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor20, $competitor16,
            $competitor20->getTeam(), $competitor16->getTeam(),
            $competitor20->getUser(), $competitor16->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);
        $match6 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor18, $competitor17,
            $competitor18->getTeam(), $competitor17->getTeam(),
            $competitor18->getUser(), $competitor17->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-07'), 4);
        $reported = new \DateTime('2014-01-07');
        $confirmed = new \DateTime('2014-01-07');
        $match7 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor19, $competitor18,
            $competitor19->getTeam(), $competitor18->getTeam(),
            $competitor19->getUser(), $competitor18->getUser(),
            1, 1,
            $reported, $confirmed,
            $round);
        $match8 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor17, $competitor20,
            $competitor17->getTeam(), $competitor20->getTeam(),
            $competitor17->getUser(), $competitor20->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-09'), 5);
        $reported = new \DateTime('2014-01-09');
        $confirmed = new \DateTime('2014-01-09');
        $match9 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor16, $competitor17,
            $competitor16->getTeam(), $competitor17->getTeam(),
            $competitor16->getUser(), $competitor17->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);
        $match10 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor20, $competitor19,
            $competitor20->getTeam(), $competitor19->getTeam(),
            $competitor20->getUser(), $competitor19->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-11'), 6);
        $reported = new \DateTime('2014-01-11');
        $confirmed = new \DateTime('2014-01-11');
        $match11 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor20, $competitor18,
            $competitor20->getTeam(), $competitor18->getTeam(),
            $competitor20->getUser(), $competitor18->getUser(),
            3, 3,
            $reported, $confirmed,
            $round);
        $match12 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor16, $competitor19,
            $competitor16->getTeam(), $competitor19->getTeam(),
            $competitor16->getUser(), $competitor19->getUser(),
            4, 3,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-13'), 7);
        $reported = new \DateTime('2014-01-13');
        $confirmed = new \DateTime('2014-01-13');
        $match13 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor19, $competitor17,
            $competitor19->getTeam(), $competitor17->getTeam(),
            $competitor19->getUser(), $competitor17->getUser(),
            2, 3,
            $reported, $confirmed,
            $round);
        $match14 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor18, $competitor16,
            $competitor18->getTeam(), $competitor16->getTeam(),
            $competitor18->getUser(), $competitor16->getUser(),
            2, 2,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-15'), 8);
        $reported = new \DateTime('2014-01-15');
        $confirmed = new \DateTime('2014-01-15');
        $match15 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor16, $competitor20,
            $competitor16->getTeam(), $competitor20->getTeam(),
            $competitor16->getUser(), $competitor20->getUser(),
            0, 0,
            $reported, $confirmed,
            $round);
        $match16 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor17, $competitor18,
            $competitor17->getTeam(), $competitor18->getTeam(),
            $competitor17->getUser(), $competitor18->getUser(),
            2, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-17'), 9);
        $reported = new \DateTime('2014-01-17');
        $confirmed = new \DateTime('2014-01-17');
        $match17 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor18, $competitor19,
            $competitor18->getTeam(), $competitor19->getTeam(),
            $competitor18->getUser(), $competitor19->getUser(),
            3, 1,
            $reported, $confirmed,
            $round);
        $match18 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor20, $competitor17,
            $competitor20->getTeam(), $competitor17->getTeam(),
            $competitor20->getUser(), $competitor17->getUser(),
            4, 1,
            $reported, $confirmed,
            $round);

        $round = $this->createRound(new \DateTime('2014-01-19'), 10);
        $reported = new \DateTime('2014-01-19');
        $confirmed = new \DateTime('2014-01-19');
        $match19 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor17, $competitor16,
            $competitor17->getTeam(), $competitor16->getTeam(),
            $competitor17->getUser(), $competitor16->getUser(),
            5, 1,
            $reported, $confirmed,
            $round);
        $match20 = $this->createMatch(
            $superLeague2, $worldSeason1,
            $competitor19, $competitor20,
            $competitor19->getTeam(), $competitor20->getTeam(),
            $competitor19->getUser(), $competitor20->getUser(),
            0, 1,
            $reported, $confirmed,
            $round);

        $this->manager->persist($match1);
        $this->manager->persist($match2);
        $this->manager->persist($match3);
        $this->manager->persist($match4);
        $this->manager->persist($match5);
        $this->manager->persist($match6);
        $this->manager->persist($match7);
        $this->manager->persist($match8);
        $this->manager->persist($match9);
        $this->manager->persist($match10);
        $this->manager->persist($match11);
        $this->manager->persist($match12);
        $this->manager->persist($match13);
        $this->manager->persist($match14);
        $this->manager->persist($match15);
        $this->manager->persist($match16);
        $this->manager->persist($match17);
        $this->manager->persist($match18);
        $this->manager->persist($match19);
        $this->manager->persist($match20);

        $this->manager->flush();
    }

    /**
     * @param \DateTime $startDate
     * @param int $roundNumber
     * @return Round
     */
    private function createRound(\DateTime $startDate, $roundNumber)
    {
        $round = new Round();
        $round->setStartDate($startDate);
        $round->setRound($roundNumber);
        return $round;
    }

    private function createMatch(
        Competition $competition,
        Season $season,
        Competitor $homeCompetitor,
        Competitor $awayCompetitor,
        Team $homeTeam,
        Team $awayTeam,
        User $homeUser,
        User $awayUser,
        $homeScore,
        $awayScore,
        \DateTime $reported,
        \DateTime $confirmed,
        Round $round)
    {
        $match = new Match();
        $match->setCompetition($competition);
        $match->setSeason($season);
        $match->setHomeCompetitor($homeCompetitor);
        $match->setAwayCompetitor($awayCompetitor);
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setHomeUser($homeUser);
        $match->setAwayUser($awayUser);
        $match->setHomeScore($homeScore);
        $match->setAwayScore($awayScore);
        $match->setReported($reported);
        $match->setConfirmed($confirmed);
        $match->setRound($round);
        $match->setStatus(MatchStatus::CONFIRMED);
        return $match;
    }

    private function getParticipantsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $participants = [];

        $i = 1;
        $foo = true;
        while ($foo) {
            try {
                $participants[] = $this->getReference('participant.competition.'
                    . $competition->getAssociation()->getSlug() . '-'
                    . $competition->getDivision() . '.'
                    . 'season-' . $season->getNumber() . '-' . $i);
            } catch (\Exception $e) {
                $foo = false;
            }

            $i++;
        }

        return $participants;
    }

    /**
     * @param string $key
     * @return Competition
     */
    private function getCompetition($key)
    {
        return $this->getReference('competition.'.$key);
    }

    /**
     * @param string $key
     * @return Season
     */
    private function getSeason($key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @param string $key
     * @return Competitor
     */
    private function getCompetitor($key)
    {
        return $this->getReference('competitor.'.$key);
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->container->get('elite_fifa.match_service');
    }

    public function getDependencies()
    {
        return [
            CompetitorFixtures::class,
            UserFixtures::class
        ];
    }
}