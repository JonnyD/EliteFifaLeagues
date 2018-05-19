<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competition\CompetitionFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Enum\CompetitorStatus;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\DataFixtures\ORM\Prod\Team\TeamFixtures;
use EliteFifa\TeamBundle\Entity\Team;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CompetitorFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;

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
        $this->createEliteLeague1Competitors($manager);
        $this->createEliteLeague2Competitors($manager);
        $this->createSuperLeague1Competitors($manager);
        $this->createSuperLeague2Competitors($manager);
        $this->createPremierLeague1Competitors($manager);
        $this->createPremierLeague2Competitors($manager);
        $this->createUltraLeague1Competitors($manager);
        $this->createUltraLeague2Competitors($manager);

        $this->createChampionsLeagueGroupACompetitors($manager);
        $this->createChampionsLeagueGroupBCompetitors($manager);
        $this->createChampionsLeagueGroupCCompetitors($manager);
        $this->createChampionsLeagueGroupDCompetitors($manager);
    }

    private function createEliteLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague1 = $this->getCompetition('elite-league-1');

        $liverpool = $this->getTeam('Liverpool');
        $realMadrid = $this->getTeam('Real Madrid');
        $borussiaDortmund = $this->getTeam('Borussia Dortmund');
        $chelsea = $this->getTeam('Chelsea');
        $barcelona = $this->getTeam('Barcelona');
        $parma = $this->getTeam('Parma');

        $competitor1 = $this->createCompetitor($liverpool, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor2 = $this->createCompetitor($realMadrid, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor3 = $this->createCompetitor($borussiaDortmund, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor4 = $this->createCompetitor($chelsea, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor5 = $this->createCompetitor($barcelona, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor6 = $this->createCompetitor($parma, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor1);
        $manager->persist($competitor2);
        $manager->persist($competitor3);
        $manager->persist($competitor4);
        $manager->persist($competitor5);
        $manager->persist($competitor6);
        $manager->flush();

        $this->addCompetitor('liverpool', $competitor1);
        $this->addCompetitor('realMadrid', $competitor2);
        $this->addCompetitor('borussiaDortmund', $competitor3);
        $this->addCompetitor('chelsea', $competitor4);
        $this->addCompetitor('barcelona', $competitor5);
        $this->addCompetitor('parma', $competitor6);
    }

    private function createEliteLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague2 = $this->getCompetition('elite-league-2');

        $arsenal = $this->getTeam('Arsenal');
        $manchesterUnited = $this->getTeam('Manchester United');
        $bayernMunich = $this->getTeam('Bayern Munich');
        $milan = $this->getTeam('Milan');
        $athleticoMadrid = $this->getTeam('Athletico Madrid');

        $competitor6 = $this->createCompetitor($arsenal, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor7 = $this->createCompetitor($manchesterUnited, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor8 = $this->createCompetitor($bayernMunich, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor9 = $this->createCompetitor($milan, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor10 = $this->createCompetitor($athleticoMadrid, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor6);
        $manager->persist($competitor7);
        $manager->persist($competitor8);
        $manager->persist($competitor9);
        $manager->persist($competitor10);
        $manager->flush();

        $this->addCompetitor('arsenal', $competitor6);
        $this->addCompetitor('manUnited', $competitor7);
        $this->addCompetitor('bayernMunich', $competitor8);
        $this->addCompetitor('milan', $competitor9);
        $this->addCompetitor('athleticoMadrid', $competitor10);
    }

    private function createSuperLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague1 = $this->getCompetition('super-league-1');

        $tottenham = $this->getTeam('Tottenham Hotspur');
        $roma = $this->getTeam('Roma');
        $inter = $this->getTeam('Inter');
        $psg = $this->getTeam('Paris Saint-Germain');
        $juventus = $this->getTeam('Juventus');

        $competitor11 = $this->createCompetitor($tottenham, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor12 = $this->createCompetitor($roma, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor13 = $this->createCompetitor($inter, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor14 = $this->createCompetitor($psg, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor15 = $this->createCompetitor($juventus, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor11);
        $manager->persist($competitor12);
        $manager->persist($competitor13);
        $manager->persist($competitor14);
        $manager->persist($competitor15);
        $manager->flush();

        $this->addCompetitor('tottenham', $competitor11);
        $this->addCompetitor('roma', $competitor12);
        $this->addCompetitor('inter', $competitor13);
        $this->addCompetitor('psg', $competitor14);
        $this->addCompetitor('juventus', $competitor15);
    }

    private function createSuperLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague2 = $this->getCompetition('super-league-2');

        $manCity = $this->getTeam('Manchester City');
        $everton = $this->getTeam('Everton');
        $southampton = $this->getTeam('Southampton');
        $fcSchalke = $this->getTeam('FC Schalke');
        $valencia = $this->getTeam('Valencia');

        $competitor16 = $this->createCompetitor($manCity, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor17 = $this->createCompetitor($everton, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor18 = $this->createCompetitor($southampton, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor19 = $this->createCompetitor($fcSchalke, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor20 = $this->createCompetitor($valencia, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor16);
        $manager->persist($competitor17);
        $manager->persist($competitor18);
        $manager->persist($competitor19);
        $manager->persist($competitor20);
        $manager->flush();

        $this->addCompetitor('manCity', $competitor16);
        $this->addCompetitor('everton', $competitor17);
        $this->addCompetitor('southampton', $competitor18);
        $this->addCompetitor('fcSchalke', $competitor19);
        $this->addCompetitor('valencia', $competitor20);
    }

    private function createPremierLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague1 = $this->getCompetition('premier-league-1');

        $napoli = $this->getTeam('Napoli');
        $lyon = $this->getTeam('Lyon');
        $asMonaco = $this->getTeam('AS Monaco');
        $sportLisbon = $this->getTeam('Sport Lisbon');
        $ajax = $this->getTeam('Ajax');

        $competitor21 = $this->createCompetitor($napoli, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor22 = $this->createCompetitor($lyon, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor23 = $this->createCompetitor($asMonaco, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor24 = $this->createCompetitor($sportLisbon, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor25 = $this->createCompetitor($ajax, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor21);
        $manager->persist($competitor22);
        $manager->persist($competitor23);
        $manager->persist($competitor24);
        $manager->persist($competitor25);
        $manager->flush();

        $this->addCompetitor('napoli', $competitor21);
        $this->addCompetitor('lyon', $competitor22);
        $this->addCompetitor('asMonaco', $competitor23);
        $this->addCompetitor('sportLisbon', $competitor24);
        $this->addCompetitor('ajax', $competitor25);
    }

    private function createPremierLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague2 = $this->getCompetition('premier-league-2');

        $fcPorto = $this->getTeam('FC Porto');
        $sunderland = $this->getTeam('Sunderland');
        $bayerLeverkusen = $this->getTeam('Bayer Leverkusen');
        $galatasary = $this->getTeam('Galatasaray');
        $sportingCP = $this->getTeam('Sporting CP');

        $competitor26 = $this->createCompetitor($fcPorto, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor27 = $this->createCompetitor($sunderland, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor28 = $this->createCompetitor($bayerLeverkusen, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor29 = $this->createCompetitor($galatasary, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor30 = $this->createCompetitor($sportingCP, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor26);
        $manager->persist($competitor27);
        $manager->persist($competitor28);
        $manager->persist($competitor29);
        $manager->persist($competitor30);
        $manager->flush();

        $this->addCompetitor('fcPorto', $competitor26);
        $this->addCompetitor('sunderland', $competitor27);
        $this->addCompetitor('bayerLeverkusen', $competitor28);
        $this->addCompetitor('galatasary', $competitor29);
        $this->addCompetitor('sportingCP', $competitor30);
    }

    private function createUltraLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague1 = $this->getCompetition('ultra-league-1');

        $lazio = $this->getTeam('Lazio');
        $astonVilla = $this->getTeam('Aston Villa');
        $newcastleUnited = $this->getTeam('Newcastle United');
        $hamburgerSV = $this->getTeam('Hamburger SV');
        $realSociedad = $this->getTeam('Real Sociedad');

        $competitor31 = $this->createCompetitor($lazio, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor32 = $this->createCompetitor($astonVilla, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor33 = $this->createCompetitor($newcastleUnited, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor34 = $this->createCompetitor($hamburgerSV, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor35 = $this->createCompetitor($realSociedad, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor31);
        $manager->persist($competitor32);
        $manager->persist($competitor33);
        $manager->persist($competitor34);
        $manager->persist($competitor35);
        $manager->flush();

        $this->addCompetitor('lazio', $competitor31);
        $this->addCompetitor('astonVilla', $competitor32);
        $this->addCompetitor('newcastleUnited', $competitor33);
        $this->addCompetitor('hamburgerSV', $competitor34);
        $this->addCompetitor('realSociedad', $competitor35);
    }

    private function createUltraLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague2 = $this->getCompetition('ultra-league-2');

        $sevilla = $this->getTeam('Sevilla');
        $ogcNice = $this->getTeam('OGC Nice');
        $rbLeipzig = $this->getTeam('RB Leipzig');
        $malaga = $this->getTeam('Malaga');
        $leicesterCity = $this->getTeam('Leicester City');

        $competitor36 = $this->createCompetitor($sevilla, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor37 = $this->createCompetitor($ogcNice, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor38 = $this->createCompetitor($rbLeipzig, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor39 = $this->createCompetitor($malaga, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor40 = $this->createCompetitor($leicesterCity, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor36);
        $manager->persist($competitor37);
        $manager->persist($competitor38);
        $manager->persist($competitor39);
        $manager->persist($competitor40);
        $manager->flush();

        $this->addCompetitor('sevilla', $competitor36);
        $this->addCompetitor('ogcNice', $competitor37);
        $this->addCompetitor('rbLeipzig', $competitor38);
        $this->addCompetitor('malaga', $competitor39);
        $this->addCompetitor('leicesterCity', $competitor40);
    }

    /**
     * @param ObjectManager $manager
     */
    public function createChampionsLeagueGroupACompetitors(ObjectManager $manager)
    {
        $groupA = $this->getCompetition('group-a');

        $liverpool = $this->getCompetitor('liverpool');
        $roma = $this->getCompetitor('roma');
        $asMonaco = $this->getCompetitor('asMonaco');
        $hamburgerSV = $this->getCompetitor('hamburgerSV');

        $liverpool->addCompetition($groupA);
        $roma->addCompetition($groupA);
        $asMonaco->addCompetition($groupA);
        $hamburgerSV->addCompetition($groupA);

        $manager->persist($liverpool);
        $manager->persist($roma);
        $manager->persist($asMonaco);
        $manager->persist($hamburgerSV);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function createChampionsLeagueGroupBCompetitors(ObjectManager $manager)
    {
        $groupB = $this->getCompetition('group-b');

        $tottenham = $this->getCompetitor('tottenham');
        $realMadrid = $this->getCompetitor('realMadrid');
        $newcastleUnited = $this->getCompetitor('newcastleUnited');
        $sportLisbon = $this->getCompetitor('sportLisbon');

        $tottenham->addCompetition($groupB);
        $realMadrid->addCompetition($groupB);
        $newcastleUnited->addCompetition($groupB);
        $sportLisbon->addCompetition($groupB);

        $manager->persist($tottenham);
        $manager->persist($realMadrid);
        $manager->persist($newcastleUnited);
        $manager->persist($sportLisbon);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function createChampionsLeagueGroupCCompetitors(ObjectManager $manager)
    {
        $groupC = $this->getCompetition('group-c');

        $napoli = $this->getCompetitor('napoli');
        $astonVilla = $this->getCompetitor('astonVilla');
        $borrusiaDortmund = $this->getCompetitor('borussiaDortmund');
        $milan = $this->getCompetitor('milan');

        $napoli->addCompetition($groupC);
        $astonVilla->addCompetition($groupC);
        $borrusiaDortmund->addCompetition($groupC);
        $milan->addCompetition($groupC);

        $manager->persist($napoli);
        $manager->persist($astonVilla);
        $manager->persist($borrusiaDortmund);
        $manager->persist($milan);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function createChampionsLeagueGroupDCompetitors(ObjectManager $manager)
    {
        $groupD = $this->getCompetition('group-d');

        $lazio = $this->getCompetitor('lazio');
        $lyon = $this->getCompetitor('lyon');
        $inter = $this->getCompetitor('inter');
        $chelsea = $this->getCompetitor('chelsea');

        $lazio->addCompetition($groupD);
        $lyon->addCompetition($groupD);
        $inter->addCompetition($groupD);
        $chelsea->addCompetition($groupD);

        $manager->persist($lazio);
        $manager->persist($lyon);
        $manager->persist($inter);
        $manager->persist($chelsea);
        $manager->flush();
    }

    /**
     * @param string $teamName
     * @return Team
     */
    private function getTeam($teamName)
    {
        return $this->getReference('team.'.$teamName);
    }

    /**
     * @param string $slug
     * @return Competition
     */
    private function getCompetition($slug)
    {
        return $this->getReference('competition.'.$slug);
    }

    /**
     * @param $key
     * @return Season
     */
    public function getSeason($key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @param Team $team
     * @param Competition $competition
     * @param Season $season
     * @param string $status
     * @return Competitor
     */
    private function createCompetitor(Team $team, Competition $competition, Season $season, string $status)
    {
        $competitor = new Competitor();
        $competitor->setTeam($team);
        $competitor->addCompetition($competition);
        $competitor->setSeason($season);
        $competitor->setStatus($status);
        return $competitor;
    }

    /**
     * @param string $key
     * @param Competitor $competitor
     */
    private function addCompetitor(string $key, Competitor $competitor)
    {
        $this->addReference('competitor.'.$key, $competitor);
    }

    /**
     * @param string $key
     * @return Competitor
     */
    public function getCompetitor(string $key)
    {
        return $this->getReference('competitor.'.$key);
    }

    /**
     * @return int
     */
    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            CompetitionFixtures::class,
            SeasonFixtures::class
        ];
    }
}