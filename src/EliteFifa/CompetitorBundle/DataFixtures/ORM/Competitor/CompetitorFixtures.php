<?php

namespace EliteFifa\CompetitorBundle\DataFixtures\ORM\Competitor;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CompetitionBundle\DataFixtures\ORM\Competition\CompetitionFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Enum\CompetitorStatus;
use EliteFifa\SeasonBundle\DataFixtures\ORM\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\DataFixtures\ORM\Team\TeamFixtures;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\DataFixtures\ORM\User\UserFixtures;
use EliteFifa\UserBundle\Entity\User;
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
    }

    private function createEliteLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague1 = $this->getCompetition('elite-league-1');

        $user1 = $this->getUser('user1');
        $user2 = $this->getUser('user2');
        $user3 = $this->getUser('user3');
        $user4 = $this->getUser('user4');
        $user5 = $this->getUser('user5');

        $liverpool = $this->getTeam('Liverpool');
        $realMadrid = $this->getTeam('Real Madrid');
        $borussiaDortmund = $this->getTeam('Borussia Dortmund');
        $chelsea = $this->getTeam('Chelsea');
        $barcelona = $this->getTeam('Barcelona');

        $competitor1 = $this->createCompetitor($liverpool, $user1, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor2 = $this->createCompetitor($realMadrid, $user2, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor3 = $this->createCompetitor($borussiaDortmund, $user3, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor4 = $this->createCompetitor($chelsea, $user4, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor5 = $this->createCompetitor($barcelona, $user5, $eliteLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor1);
        $manager->persist($competitor2);
        $manager->persist($competitor3);
        $manager->persist($competitor4);
        $manager->persist($competitor5);
        $manager->flush();

        $this->addCompetitor('competitor1', $competitor1);
        $this->addCompetitor('competitor2', $competitor2);
        $this->addCompetitor('competitor3', $competitor3);
        $this->addCompetitor('competitor4', $competitor4);
        $this->addCompetitor('competitor5', $competitor5);
    }

    private function createEliteLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague2 = $this->getCompetition('elite-league-2');

        $user6 = $this->getUser('user6');
        $user7 = $this->getUser('user7');
        $user8 = $this->getUser('user8');
        $user9 = $this->getUser('user9');
        $user10 = $this->getUser('user10');

        $arsenal = $this->getTeam('Arsenal');
        $manchesterUnited = $this->getTeam('Manchester United');
        $bayernMunich = $this->getTeam('Bayern Munich');
        $milan = $this->getTeam('Milan');
        $athleticoMadrid = $this->getTeam('Athletico Madrid');

        $competitor6 = $this->createCompetitor($arsenal, $user6, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor7 = $this->createCompetitor($manchesterUnited, $user7, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor8 = $this->createCompetitor($bayernMunich, $user8, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor9 = $this->createCompetitor($milan, $user9, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor10 = $this->createCompetitor($athleticoMadrid, $user10, $eliteLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor6);
        $manager->persist($competitor7);
        $manager->persist($competitor8);
        $manager->persist($competitor9);
        $manager->persist($competitor10);
        $manager->flush();

        $this->addCompetitor('competitor6', $competitor6);
        $this->addCompetitor('competitor7', $competitor7);
        $this->addCompetitor('competitor8', $competitor8);
        $this->addCompetitor('competitor9', $competitor9);
        $this->addCompetitor('competitor10', $competitor10);
    }

    private function createSuperLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague1 = $this->getCompetition('super-league-1');

        $user11 = $this->getUser('user11');
        $user12 = $this->getUser('user12');
        $user13 = $this->getUser('user13');
        $user14 = $this->getUser('user14');
        $user15 = $this->getUser('user15');

        $tottenham = $this->getTeam('Tottenham Hotspur');
        $roma = $this->getTeam('Roma');
        $inter = $this->getTeam('Inter');
        $psg = $this->getTeam('Paris Saint-Germain');
        $juventus = $this->getTeam('Juventus');

        $competitor11 = $this->createCompetitor($tottenham, $user11, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor12 = $this->createCompetitor($roma, $user12, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor13 = $this->createCompetitor($inter, $user13, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor14 = $this->createCompetitor($psg, $user14, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor15 = $this->createCompetitor($juventus, $user15, $superLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor11);
        $manager->persist($competitor12);
        $manager->persist($competitor13);
        $manager->persist($competitor14);
        $manager->persist($competitor15);
        $manager->flush();

        $this->addCompetitor('competitor11', $competitor11);
        $this->addCompetitor('competitor12', $competitor12);
        $this->addCompetitor('competitor13', $competitor13);
        $this->addCompetitor('competitor14', $competitor14);
        $this->addCompetitor('competitor15', $competitor15);
    }

    private function createSuperLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague2 = $this->getCompetition('super-league-2');

        $user16 = $this->getUser('user16');
        $user17 = $this->getUser('user17');
        $user18 = $this->getUser('user18');
        $user19 = $this->getUser('user19');
        $user20 = $this->getUser('user20');

        $manCity = $this->getTeam('Manchester City');
        $everton = $this->getTeam('Everton');
        $southampton = $this->getTeam('Southampton');
        $fcSchalke = $this->getTeam('FC Schalke');
        $valencia = $this->getTeam('Valencia');

        $competitor16 = $this->createCompetitor($manCity, $user16, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor17 = $this->createCompetitor($everton, $user17, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor18 = $this->createCompetitor($southampton, $user18, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor19 = $this->createCompetitor($fcSchalke, $user19, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor20 = $this->createCompetitor($valencia, $user20, $superLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor16);
        $manager->persist($competitor17);
        $manager->persist($competitor18);
        $manager->persist($competitor19);
        $manager->persist($competitor20);
        $manager->flush();

        $this->addCompetitor('competitor16', $competitor16);
        $this->addCompetitor('competitor17', $competitor17);
        $this->addCompetitor('competitor18', $competitor18);
        $this->addCompetitor('competitor19', $competitor19);
        $this->addCompetitor('competitor20', $competitor20);
    }

    private function createPremierLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague1 = $this->getCompetition('premier-league-1');

        $user21 = $this->getUser('user21');
        $user22 = $this->getUser('user22');
        $user23 = $this->getUser('user23');
        $user24 = $this->getUser('user24');
        $user25 = $this->getUser('user25');

        $napoli = $this->getTeam('Napoli');
        $lyon = $this->getTeam('Lyon');
        $asMonaco = $this->getTeam('AS Monaco');
        $sportLisbon = $this->getTeam('Sport Lisbon');
        $ajax = $this->getTeam('Ajax');

        $competitor21 = $this->createCompetitor($napoli, $user21, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor22 = $this->createCompetitor($lyon, $user22, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor23 = $this->createCompetitor($asMonaco, $user23, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor24 = $this->createCompetitor($sportLisbon, $user24, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor25 = $this->createCompetitor($ajax, $user25, $premierLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor21);
        $manager->persist($competitor22);
        $manager->persist($competitor23);
        $manager->persist($competitor24);
        $manager->persist($competitor25);
        $manager->flush();

        $this->addCompetitor('competitor21', $competitor21);
        $this->addCompetitor('competitor22', $competitor22);
        $this->addCompetitor('competitor23', $competitor23);
        $this->addCompetitor('competitor24', $competitor24);
        $this->addCompetitor('competitor25', $competitor25);
    }

    private function createPremierLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague2 = $this->getCompetition('premier-league-2');

        $user26 = $this->getUser('user26');
        $user27 = $this->getUser('user27');
        $user28 = $this->getUser('user28');
        $user29 = $this->getUser('user29');
        $user30 = $this->getUser('user30');

        $fcPorto = $this->getTeam('FC Porto');
        $sunderland = $this->getTeam('Sunderland');
        $bayerLeverkusen = $this->getTeam('Bayer Leverkusen');
        $galatasary = $this->getTeam('Galatasaray');
        $sportingCP = $this->getTeam('Sporting CP');

        $competitor26 = $this->createCompetitor($fcPorto, $user26, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor27 = $this->createCompetitor($sunderland, $user27, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor28 = $this->createCompetitor($bayerLeverkusen, $user28, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor29 = $this->createCompetitor($galatasary, $user29, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor30 = $this->createCompetitor($sportingCP, $user30, $premierLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor26);
        $manager->persist($competitor27);
        $manager->persist($competitor28);
        $manager->persist($competitor29);
        $manager->persist($competitor30);
        $manager->flush();

        $this->addCompetitor('competitor26', $competitor26);
        $this->addCompetitor('competitor27', $competitor27);
        $this->addCompetitor('competitor28', $competitor28);
        $this->addCompetitor('competitor29', $competitor29);
        $this->addCompetitor('competitor30', $competitor30);
    }

    private function createUltraLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague1 = $this->getCompetition('ultra-league-1');

        $user31 = $this->getUser('user31');
        $user32 = $this->getUser('user32');
        $user33 = $this->getUser('user33');
        $user34 = $this->getUser('user34');
        $user35 = $this->getUser('user35');

        $lazio = $this->getTeam('Lazio');
        $astonVilla = $this->getTeam('Aston Villa');
        $newcastleUnited = $this->getTeam('Newcastle United');
        $hamburgerSV = $this->getTeam('Hamburger SV');
        $realSociedad = $this->getTeam('Real Sociedad');

        $competitor31 = $this->createCompetitor($lazio, $user31, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor32 = $this->createCompetitor($astonVilla, $user32, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor33 = $this->createCompetitor($newcastleUnited, $user33, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor34 = $this->createCompetitor($hamburgerSV, $user34, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor35 = $this->createCompetitor($realSociedad, $user35, $ultraLeague1, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor31);
        $manager->persist($competitor32);
        $manager->persist($competitor33);
        $manager->persist($competitor34);
        $manager->persist($competitor35);
        $manager->flush();

        $this->addCompetitor('competitor31', $competitor31);
        $this->addCompetitor('competitor32', $competitor32);
        $this->addCompetitor('competitor33', $competitor33);
        $this->addCompetitor('competitor34', $competitor34);
        $this->addCompetitor('competitor35', $competitor35);
    }

    private function createUltraLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague2 = $this->getCompetition('ultra-league-2');

        $user36 = $this->getUser('user36');
        $user37 = $this->getUser('user37');
        $user38 = $this->getUser('user38');
        $user39 = $this->getUser('user39');
        $user40 = $this->getUser('user40');

        $sevilla = $this->getTeam('Sevilla');
        $ogcNice = $this->getTeam('OGC Nice');
        $rbLeipzig = $this->getTeam('RB Leipzig');
        $malaga = $this->getTeam('Malaga');
        $leicesterCity = $this->getTeam('Leicester City');

        $competitor36 = $this->createCompetitor($sevilla, $user36, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor37 = $this->createCompetitor($ogcNice, $user37, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor38 = $this->createCompetitor($rbLeipzig, $user38, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor39 = $this->createCompetitor($malaga, $user39, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor40 = $this->createCompetitor($leicesterCity, $user40, $ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor36);
        $manager->persist($competitor37);
        $manager->persist($competitor38);
        $manager->persist($competitor39);
        $manager->persist($competitor40);
        $manager->flush();

        $this->addCompetitor('competitor36', $competitor36);
        $this->addCompetitor('competitor37', $competitor37);
        $this->addCompetitor('competitor38', $competitor38);
        $this->addCompetitor('competitor39', $competitor39);
        $this->addCompetitor('competitor40', $competitor40);
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
     * @param string $username
     * @return User
     */
    private function getUser($username)
    {
        return $this->getReference('user.'.$username);
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
     * @param User $user
     * @param Competition $competition
     * @param Season $season
     * @param string $status
     * @return Competitor
     */
    private function createCompetitor(Team $team, User $user, Competition $competition, Season $season, string $status)
    {
        $competitor = new Competitor();
        $competitor->setTeam($team);
        $competitor->setUser($user);
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
     * @return int
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TeamFixtures::class,
            CompetitionFixtures::class,
            SeasonFixtures::class
        ];
    }
}