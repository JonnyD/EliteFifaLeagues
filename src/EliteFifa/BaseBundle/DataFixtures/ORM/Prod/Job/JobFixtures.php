<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competition\CompetitionFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor\CompetitorFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Region\RegionFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\JobBundle\Entity\Job;
use EliteFifa\RegionBundle\Entity\Region;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $worldRegion = $this->getRegion('World');
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');
        $job1 = $this->createJob($worldRegion, $eliteLeague1, $competitor1);
        $job2 = $this->createJob($worldRegion, $eliteLeague1, $competitor2);
        $job3 = $this->createJob($worldRegion, $eliteLeague1, $competitor3);
        $job4 = $this->createJob($worldRegion, $eliteLeague1, $competitor4);
        $job5 = $this->createJob($worldRegion, $eliteLeague1, $competitor5);
        $manager->persist($job1);
        $manager->persist($job2);
        $manager->persist($job3);
        $manager->persist($job4);
        $manager->persist($job5);
        $manager->flush();

        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $competitor6 = $this->getCompetitor('competitor6');
        $competitor7 = $this->getCompetitor('competitor7');
        $competitor8 = $this->getCompetitor('competitor8');
        $competitor9 = $this->getCompetitor('competitor9');
        $competitor10 = $this->getCompetitor('competitor10');
        $job6 = $this->createJob($worldRegion, $eliteLeague2, $competitor6);
        $job7 = $this->createJob($worldRegion, $eliteLeague2, $competitor7);
        $job8 = $this->createJob($worldRegion, $eliteLeague2, $competitor8);
        $job9 = $this->createJob($worldRegion, $eliteLeague2, $competitor9);
        $job10 = $this->createJob($worldRegion, $eliteLeague2, $competitor10);
        $manager->persist($job6);
        $manager->persist($job7);
        $manager->persist($job8);
        $manager->persist($job9);
        $manager->persist($job10);
        $manager->flush();

        $superLeague1 = $this->getCompetition('super-league-1');
        $competitor11 = $this->getCompetitor('competitor11');
        $competitor12 = $this->getCompetitor('competitor12');
        $competitor13 = $this->getCompetitor('competitor13');
        $competitor14 = $this->getCompetitor('competitor14');
        $competitor15 = $this->getCompetitor('competitor15');
        $job11 = $this->createJob($worldRegion, $superLeague1, $competitor11);
        $job12 = $this->createJob($worldRegion, $superLeague1, $competitor12);
        $job13 = $this->createJob($worldRegion, $superLeague1, $competitor13);
        $job14 = $this->createJob($worldRegion, $superLeague1, $competitor14);
        $job15 = $this->createJob($worldRegion, $superLeague1, $competitor15);
        $manager->persist($job11);
        $manager->persist($job12);
        $manager->persist($job13);
        $manager->persist($job14);
        $manager->persist($job15);
        $manager->flush();

        $superLeague2 = $this->getCompetition('super-league-2');
        $competitor16 = $this->getCompetitor('competitor16');
        $competitor17 = $this->getCompetitor('competitor17');
        $competitor18 = $this->getCompetitor('competitor18');
        $competitor19 = $this->getCompetitor('competitor19');
        $competitor20 = $this->getCompetitor('competitor20');
        $job16 = $this->createJob($worldRegion, $superLeague2, $competitor16);
        $job17 = $this->createJob($worldRegion, $superLeague2, $competitor17);
        $job18 = $this->createJob($worldRegion, $superLeague2, $competitor18);
        $job19 = $this->createJob($worldRegion, $superLeague2, $competitor19);
        $job20 = $this->createJob($worldRegion, $superLeague2, $competitor20);
        $manager->persist($job16);
        $manager->persist($job17);
        $manager->persist($job18);
        $manager->persist($job19);
        $manager->persist($job20);
        $manager->flush();

        $premierLeague1 = $this->getCompetition('premier-league-1');
        $competitor21 = $this->getCompetitor('competitor21');
        $competitor22 = $this->getCompetitor('competitor22');
        $competitor23 = $this->getCompetitor('competitor23');
        $competitor24 = $this->getCompetitor('competitor24');
        $competitor25 = $this->getCompetitor('competitor25');
        $job21 = $this->createJob($worldRegion, $premierLeague1, $competitor21);
        $job22 = $this->createJob($worldRegion, $premierLeague1, $competitor22);
        $job23 = $this->createJob($worldRegion, $premierLeague1, $competitor23);
        $job24 = $this->createJob($worldRegion, $premierLeague1, $competitor24);
        $job25 = $this->createJob($worldRegion, $premierLeague1, $competitor25);
        $manager->persist($job21);
        $manager->persist($job22);
        $manager->persist($job23);
        $manager->persist($job24);
        $manager->persist($job25);
        $manager->flush();

        $premierLeague2 = $this->getCompetition('premier-league-2');
        $competitor26 = $this->getCompetitor('competitor26');
        $competitor27 = $this->getCompetitor('competitor27');
        $competitor28 = $this->getCompetitor('competitor28');
        $competitor29 = $this->getCompetitor('competitor29');
        $competitor30 = $this->getCompetitor('competitor30');
        $job26 = $this->createJob($worldRegion, $premierLeague2, $competitor26);
        $job27 = $this->createJob($worldRegion, $premierLeague2, $competitor27);
        $job28 = $this->createJob($worldRegion, $premierLeague2, $competitor28);
        $job29 = $this->createJob($worldRegion, $premierLeague2, $competitor29);
        $job30 = $this->createJob($worldRegion, $premierLeague2, $competitor30);
        $manager->persist($job26);
        $manager->persist($job27);
        $manager->persist($job28);
        $manager->persist($job29);
        $manager->persist($job30);
        $manager->flush();

        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $competitor31 = $this->getCompetitor('competitor31');
        $competitor32 = $this->getCompetitor('competitor32');
        $competitor33 = $this->getCompetitor('competitor33');
        $competitor34 = $this->getCompetitor('competitor34');
        $competitor35 = $this->getCompetitor('competitor35');
        $job31 = $this->createJob($worldRegion, $ultraLeague1, $competitor31);
        $job32 = $this->createJob($worldRegion, $ultraLeague1, $competitor32);
        $job33 = $this->createJob($worldRegion, $ultraLeague1, $competitor33);
        $job34 = $this->createJob($worldRegion, $ultraLeague1, $competitor34);
        $job35 = $this->createJob($worldRegion, $ultraLeague1, $competitor35);
        $manager->persist($job31);
        $manager->persist($job32);
        $manager->persist($job33);
        $manager->persist($job34);
        $manager->persist($job35);
        $manager->flush();

        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $competitor36 = $this->getCompetitor('competitor36');
        $competitor37 = $this->getCompetitor('competitor37');
        $competitor38 = $this->getCompetitor('competitor38');
        $competitor39 = $this->getCompetitor('competitor39');
        $competitor40 = $this->getCompetitor('competitor40');
        $job36 = $this->createJob($worldRegion, $ultraLeague2, $competitor36);
        $job37 = $this->createJob($worldRegion, $ultraLeague2, $competitor37);
        $job38 = $this->createJob($worldRegion, $ultraLeague2, $competitor38);
        $job39 = $this->createJob($worldRegion, $ultraLeague2, $competitor39);
        $job40 = $this->createJob($worldRegion, $ultraLeague2, $competitor40);
        $manager->persist($job36);
        $manager->persist($job37);
        $manager->persist($job38);
        $manager->persist($job39);
        $manager->persist($job40);
        $manager->flush();
    }

    /**
     * @param Region $region
     * @param Competition $competition
     * @param Competitor $competitor
     * @return Job
     */
    private function createJob(Region $region, Competition $competition, Competitor $competitor)
    {
        $job = new Job();
        $job->setRegion($region);
        $job->setCompetition($competition);
        $job->setCompetitor($competitor);
        return $job;
    }

    /**
     * @param string $key
     * @return Region
     */
    private function getRegion(string $key)
    {
        return $this->getReference('region.'.$key);
    }

    /**
     * @param string $key
     * @return Competition
     */
    private function getCompetition(string $key)
    {
        return $this->getReference('competition.'.$key);
    }

    /**
     * @param string $key
     * @return Competitor
     */
    private function getCompetitor(string $key)
    {
        return $this->getReference('competitor.'.$key);
    }

    public function getDependencies()
    {
        return [
            RegionFixtures::class,
            CompetitionFixtures::class,
            CompetitorFixtures::class
        ];
    }
}