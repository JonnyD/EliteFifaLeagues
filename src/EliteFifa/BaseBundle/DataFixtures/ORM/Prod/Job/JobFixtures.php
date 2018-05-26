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
use EliteFifa\SeasonBundle\Entity\Season;
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
        $competitor1 = $this->getCompetitor('liverpool');
        $competitor2 = $this->getCompetitor('realMadrid');
        $competitor3 = $this->getCompetitor('borussiaDortmund');
        $competitor4 = $this->getCompetitor('chelsea');
        $competitor5 = $this->getCompetitor('barcelona');
        $competitor6 = $this->getCompetitor('parma');
        $competitor7 = $this->getCompetitor('burnley');
        $competitor8 = $this->getCompetitor('fulham');
        $competitor9 = $this->getCompetitor('villarrealCF');
        $competitor10 = $this->getCompetitor('realBetis');
        $competitor11 = $this->getCompetitor('borrussiaMonchengladbach');
        $competitor12 = $this->getCompetitor('torino');
        $job1 = $this->createJob($worldRegion, $eliteLeague1, $competitor1);
        $job2 = $this->createJob($worldRegion, $eliteLeague1, $competitor2);
        $job3 = $this->createJob($worldRegion, $eliteLeague1, $competitor3);
        $job4 = $this->createJob($worldRegion, $eliteLeague1, $competitor4);
        $job5 = $this->createJob($worldRegion, $eliteLeague1, $competitor5);
        $job6 = $this->createJob($worldRegion, $eliteLeague1, $competitor6);
        $job7 = $this->createJob($worldRegion, $eliteLeague1, $competitor7);
        $job8 = $this->createJob($worldRegion, $eliteLeague1, $competitor8);
        $job9 = $this->createJob($worldRegion, $eliteLeague1, $competitor9);
        $job10 = $this->createJob($worldRegion, $eliteLeague1, $competitor10);
        $job11 = $this->createJob($worldRegion, $eliteLeague1, $competitor11);
        $job12 = $this->createJob($worldRegion, $eliteLeague1, $competitor12);
        $manager->persist($job1);
        $manager->persist($job2);
        $manager->persist($job3);
        $manager->persist($job4);
        $manager->persist($job5);
        $manager->persist($job6);
        $manager->persist($job7);
        $manager->persist($job8);
        $manager->persist($job9);
        $manager->persist($job10);
        $manager->persist($job11);
        $manager->persist($job12);
        $manager->flush();

        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $competitor13 = $this->getCompetitor('arsenal');
        $competitor14 = $this->getCompetitor('manUnited');
        $competitor15 = $this->getCompetitor('bayernMunich');
        $competitor16 = $this->getCompetitor('milan');
        $competitor17 = $this->getCompetitor('athleticoMadrid');
        $competitor18 = $this->getCompetitor('marseille');
        $competitor19 = $this->getCompetitor('atalanta');
        $competitor20 = $this->getCompetitor('bilbao');
        $competitor21 = $this->getCompetitor('crystalPalace');
        $competitor22 = $this->getCompetitor('astonVilla');
        $competitor23 = $this->getCompetitor('celtaVigo');
        $competitor24 = $this->getCompetitor('stokeCity');
        $job13 = $this->createJob($worldRegion, $eliteLeague2, $competitor13);
        $job14 = $this->createJob($worldRegion, $eliteLeague2, $competitor14);
        $job15 = $this->createJob($worldRegion, $eliteLeague2, $competitor15);
        $job16 = $this->createJob($worldRegion, $eliteLeague2, $competitor16);
        $job17 = $this->createJob($worldRegion, $eliteLeague2, $competitor17);
        $job18 = $this->createJob($worldRegion, $eliteLeague2, $competitor18);
        $job19 = $this->createJob($worldRegion, $eliteLeague2, $competitor19);
        $job20 = $this->createJob($worldRegion, $eliteLeague2, $competitor20);
        $job21 = $this->createJob($worldRegion, $eliteLeague2, $competitor21);
        $job22 = $this->createJob($worldRegion, $eliteLeague2, $competitor22);
        $job23 = $this->createJob($worldRegion, $eliteLeague2, $competitor23);
        $job24 = $this->createJob($worldRegion, $eliteLeague2, $competitor24);;
        $manager->persist($job13);
        $manager->persist($job14);
        $manager->persist($job15);
        $manager->persist($job16);
        $manager->persist($job17);
        $manager->persist($job18);
        $manager->persist($job19);
        $manager->persist($job20);
        $manager->persist($job21);
        $manager->persist($job22);
        $manager->persist($job23);
        $manager->persist($job24);
        $manager->flush();

        $superLeague1 = $this->getCompetition('super-league-1');
        $competitor25 = $this->getCompetitor('tottenham');
        $competitor26 = $this->getCompetitor('roma');
        $competitor27 = $this->getCompetitor('inter');
        $competitor28 = $this->getCompetitor('psg');
        $competitor29 = $this->getCompetitor('juventus');
        $competitor30 = $this->getCompetitor('stuttgart');
        $competitor31 = $this->getCompetitor('werderBremen');
        $competitor32 = $this->getCompetitor('watford');
        $competitor33 = $this->getCompetitor('celtic');
        $competitor34 = $this->getCompetitor('bordeaux');
        $competitor35 = $this->getCompetitor('sampdoria');
        $competitor36 = $this->getCompetitor('cagliari');
        $job25 = $this->createJob($worldRegion, $superLeague1, $competitor25);
        $job26 = $this->createJob($worldRegion, $superLeague1, $competitor26);
        $job27 = $this->createJob($worldRegion, $superLeague1, $competitor27);
        $job28 = $this->createJob($worldRegion, $superLeague1, $competitor28);
        $job29 = $this->createJob($worldRegion, $superLeague1, $competitor29);
        $job30 = $this->createJob($worldRegion, $superLeague1, $competitor30);
        $job31 = $this->createJob($worldRegion, $superLeague1, $competitor31);
        $job32 = $this->createJob($worldRegion, $superLeague1, $competitor32);
        $job33 = $this->createJob($worldRegion, $superLeague1, $competitor33);
        $job34 = $this->createJob($worldRegion, $superLeague1, $competitor34);
        $job35 = $this->createJob($worldRegion, $superLeague1, $competitor35);
        $job36 = $this->createJob($worldRegion, $superLeague1, $competitor36);
        $manager->persist($job25);
        $manager->persist($job26);
        $manager->persist($job27);
        $manager->persist($job28);
        $manager->persist($job29);
        $manager->persist($job30);
        $manager->persist($job31);
        $manager->persist($job32);
        $manager->persist($job33);
        $manager->persist($job34);
        $manager->persist($job35);
        $manager->persist($job36);
        $manager->flush();

        $superLeague2 = $this->getCompetition('super-league-2');
        $competitor37 = $this->getCompetitor('manCity');
        $competitor38 = $this->getCompetitor('everton');
        $competitor39 = $this->getCompetitor('southampton');
        $competitor40 = $this->getCompetitor('fcSchalke');
        $competitor41 = $this->getCompetitor('valencia');
        $competitor42 = $this->getCompetitor('deportivoToluca');
        $competitor43 = $this->getCompetitor('fcKoln');
        $competitor44 = $this->getCompetitor('swanseaCity');
        $competitor45 = $this->getCompetitor('lille');
        $competitor46 = $this->getCompetitor('shakhtarDonetsk');
        $competitor47 = $this->getCompetitor('psv');
        $competitor48 = $this->getCompetitor('scFreiburg');
        $job37 = $this->createJob($worldRegion, $superLeague2, $competitor37);
        $job38 = $this->createJob($worldRegion, $superLeague2, $competitor38);
        $job39 = $this->createJob($worldRegion, $superLeague2, $competitor39);
        $job40 = $this->createJob($worldRegion, $superLeague2, $competitor40);
        $job41 = $this->createJob($worldRegion, $superLeague2, $competitor41);
        $job42 = $this->createJob($worldRegion, $superLeague2, $competitor42);
        $job43 = $this->createJob($worldRegion, $superLeague2, $competitor43);
        $job44 = $this->createJob($worldRegion, $superLeague2, $competitor44);
        $job45 = $this->createJob($worldRegion, $superLeague2, $competitor45);
        $job46 = $this->createJob($worldRegion, $superLeague2, $competitor46);
        $job47 = $this->createJob($worldRegion, $superLeague2, $competitor47);
        $job48 = $this->createJob($worldRegion, $superLeague2, $competitor48);
        $manager->persist($job37);
        $manager->persist($job38);
        $manager->persist($job39);
        $manager->persist($job40);
        $manager->persist($job41);
        $manager->persist($job42);
        $manager->persist($job43);
        $manager->persist($job44);
        $manager->persist($job45);
        $manager->persist($job46);
        $manager->persist($job47);
        $manager->persist($job48);
        $manager->flush();

        $premierLeague1 = $this->getCompetition('premier-league-1');
        $competitor49 = $this->getCompetitor('napoli');
        $competitor50 = $this->getCompetitor('lyon');
        $competitor51 = $this->getCompetitor('asMonaco');
        $competitor52 = $this->getCompetitor('sportLisbon');
        $competitor53 = $this->getCompetitor('ajax');
        $competitor54 = $this->getCompetitor('westBrom');
        $competitor55 = $this->getCompetitor('nyRedBulls');
        $competitor56 = $this->getCompetitor('riverPlate');
        $competitor57 = $this->getCompetitor('independiente');
        $competitor58 = $this->getCompetitor('saintEtienne');
        $competitor59 = $this->getCompetitor('herthaBerlin');
        $competitor60 = $this->getCompetitor('laGalaxy');
        $job49 = $this->createJob($worldRegion, $premierLeague1, $competitor49);
        $job50 = $this->createJob($worldRegion, $premierLeague1, $competitor50);
        $job51 = $this->createJob($worldRegion, $premierLeague1, $competitor51);
        $job52 = $this->createJob($worldRegion, $premierLeague1, $competitor52);
        $job53 = $this->createJob($worldRegion, $premierLeague1, $competitor53);
        $job54 = $this->createJob($worldRegion, $premierLeague1, $competitor54);
        $job55 = $this->createJob($worldRegion, $premierLeague1, $competitor55);
        $job56 = $this->createJob($worldRegion, $premierLeague1, $competitor56);
        $job57 = $this->createJob($worldRegion, $premierLeague1, $competitor57);
        $job58 = $this->createJob($worldRegion, $premierLeague1, $competitor58);
        $job59 = $this->createJob($worldRegion, $premierLeague1, $competitor59);
        $job60 = $this->createJob($worldRegion, $premierLeague1, $competitor60);
        $manager->persist($job49);
        $manager->persist($job50);
        $manager->persist($job51);
        $manager->persist($job52);
        $manager->persist($job53);
        $manager->persist($job54);
        $manager->persist($job55);
        $manager->persist($job56);
        $manager->persist($job57);
        $manager->persist($job58);
        $manager->persist($job59);
        $manager->persist($job60);
        $manager->flush();

        $premierLeague2 = $this->getCompetition('premier-league-2');
        $competitor61 = $this->getCompetitor('fcPorto');
        $competitor62 = $this->getCompetitor('sunderland');
        $competitor63 = $this->getCompetitor('bayerLeverkusen');
        $competitor64 = $this->getCompetitor('galatasary');
        $competitor65 = $this->getCompetitor('sportingCP');
        $competitor66 = $this->getCompetitor('bournemouth');
        $competitor67 = $this->getCompetitor('scBraga');
        $competitor68 = $this->getCompetitor('sassuolo');
        $competitor69 = $this->getCompetitor('deportivoAlaves');
        $competitor70 = $this->getCompetitor('hannover96');
        $competitor71 = $this->getCompetitor('udLasPalmas');
        $competitor72 = $this->getCompetitor('fcAugsburg');
        $job61 = $this->createJob($worldRegion, $premierLeague2, $competitor61);
        $job62 = $this->createJob($worldRegion, $premierLeague2, $competitor62);
        $job63 = $this->createJob($worldRegion, $premierLeague2, $competitor63);
        $job64 = $this->createJob($worldRegion, $premierLeague2, $competitor64);
        $job65 = $this->createJob($worldRegion, $premierLeague2, $competitor65);
        $job66 = $this->createJob($worldRegion, $premierLeague2, $competitor66);
        $job67 = $this->createJob($worldRegion, $premierLeague2, $competitor67);
        $job68 = $this->createJob($worldRegion, $premierLeague2, $competitor68);
        $job69 = $this->createJob($worldRegion, $premierLeague2, $competitor69);
        $job70 = $this->createJob($worldRegion, $premierLeague2, $competitor70);
        $job71 = $this->createJob($worldRegion, $premierLeague2, $competitor71);
        $job72 = $this->createJob($worldRegion, $premierLeague2, $competitor72);
        $manager->persist($job61);
        $manager->persist($job62);
        $manager->persist($job63);
        $manager->persist($job64);
        $manager->persist($job65);
        $manager->persist($job66);
        $manager->persist($job67);
        $manager->persist($job68);
        $manager->persist($job69);
        $manager->persist($job70);
        $manager->persist($job71);
        $manager->persist($job72);
        $manager->flush();

        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $competitor73 = $this->getCompetitor('lazio');
        $competitor74 = $this->getCompetitor('astonVilla');
        $competitor75 = $this->getCompetitor('newcastleUnited');
        $competitor76 = $this->getCompetitor('hamburgerSV');
        $competitor77 = $this->getCompetitor('realSociedad');
        $competitor78 = $this->getCompetitor('huddersfield');
        $competitor79 = $this->getCompetitor('getafe');
        $competitor80 = $this->getCompetitor('wolves');
        $competitor81 = $this->getCompetitor('anderlecht');
        $competitor82 = $this->getCompetitor('fcBasel');
        $competitor83 = $this->getCompetitor('fcUtrecht');
        $competitor84 = $this->getCompetitor('gironaCF');
        $job73 = $this->createJob($worldRegion, $ultraLeague1, $competitor73);
        $job74 = $this->createJob($worldRegion, $ultraLeague1, $competitor74);
        $job75 = $this->createJob($worldRegion, $ultraLeague1, $competitor75);
        $job76 = $this->createJob($worldRegion, $ultraLeague1, $competitor76);
        $job77 = $this->createJob($worldRegion, $ultraLeague1, $competitor77);
        $job78 = $this->createJob($worldRegion, $ultraLeague1, $competitor78);
        $job79 = $this->createJob($worldRegion, $ultraLeague1, $competitor79);
        $job80 = $this->createJob($worldRegion, $ultraLeague1, $competitor80);
        $job81 = $this->createJob($worldRegion, $ultraLeague1, $competitor81);
        $job82 = $this->createJob($worldRegion, $ultraLeague1, $competitor82);
        $job83 = $this->createJob($worldRegion, $ultraLeague1, $competitor83);
        $job84 = $this->createJob($worldRegion, $ultraLeague1, $competitor84);
        $manager->persist($job73);
        $manager->persist($job74);
        $manager->persist($job75);
        $manager->persist($job76);
        $manager->persist($job77);
        $manager->persist($job78);
        $manager->persist($job79);
        $manager->persist($job80);
        $manager->persist($job81);
        $manager->persist($job82);
        $manager->persist($job83);
        $manager->persist($job84);
        $manager->flush();

        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $competitor85 = $this->getCompetitor('sevilla');
        $competitor86 = $this->getCompetitor('ogcNice');
        $competitor87 = $this->getCompetitor('rbLeipzig');
        $competitor88 = $this->getCompetitor('malaga');
        $competitor89 = $this->getCompetitor('leicesterCity');
        $competitor90 = $this->getCompetitor('derbyCounty');
        $competitor91 = $this->getCompetitor('bocaJuniors');
        $competitor92 = $this->getCompetitor('cdLeganes');
        $competitor93 = $this->getCompetitor('mainz');
        $competitor94 = $this->getCompetitor('brighton');
        $competitor95 = $this->getCompetitor('athens');
        $competitor96 = $this->getCompetitor('toulouse');
        $job85 = $this->createJob($worldRegion, $ultraLeague2, $competitor85);
        $job86 = $this->createJob($worldRegion, $ultraLeague2, $competitor86);
        $job87 = $this->createJob($worldRegion, $ultraLeague2, $competitor87);
        $job88 = $this->createJob($worldRegion, $ultraLeague2, $competitor88);
        $job89 = $this->createJob($worldRegion, $ultraLeague2, $competitor89);
        $job90 = $this->createJob($worldRegion, $ultraLeague2, $competitor90);
        $job91 = $this->createJob($worldRegion, $ultraLeague2, $competitor91);
        $job92 = $this->createJob($worldRegion, $ultraLeague2, $competitor92);
        $job93 = $this->createJob($worldRegion, $ultraLeague2, $competitor93);
        $job94 = $this->createJob($worldRegion, $ultraLeague2, $competitor94);
        $job95 = $this->createJob($worldRegion, $ultraLeague2, $competitor95);
        $job96 = $this->createJob($worldRegion, $ultraLeague2, $competitor96);
        $manager->persist($job85);
        $manager->persist($job86);
        $manager->persist($job87);
        $manager->persist($job88);
        $manager->persist($job89);
        $manager->persist($job90);
        $manager->persist($job91);
        $manager->persist($job92);
        $manager->persist($job93);
        $manager->persist($job94);
        $manager->persist($job95);
        $manager->persist($job96);
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
        $job->setSeason($this->getSeason('season-1'));
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

    /**
     * @param string $key
     * @return Season
     */
    private function getSeason(string $key)
    {
        return $this->getReference('season.'.$key);
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