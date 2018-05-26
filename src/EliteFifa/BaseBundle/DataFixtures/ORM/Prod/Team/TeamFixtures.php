<?php

namespace EliteFifa\TeamBundle\DataFixtures\ORM\Prod\Team;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Stadium\StadiumFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\User\UserFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;
use EliteFifa\StadiumBundle\Entity\Stadium;

class TeamFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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

        $this->createTeam("Liverpool", "user1", "Anfield", 80, '9.png');
        $this->createTeam("Real Madrid", "user2", "Santiago Bernabéu", 84, '243.png');
        $this->createTeam("Borussia Dortmund", "user3", "Signal Iduna Park", 81, '22.png');
        $this->createTeam("Chelsea", "user4", "Stamford Bridge", 82, '5.png');
        $this->createTeam("Barcelona", "user5", "Camp Nou", 84, '241.png');
        $this->createTeam('Parma', "user6", "Arena d'Oro", 70, '');
        $this->createTeam('Burnley', "user7", "Turf Moor", 77, '');
        $this->createTeam('Fulham', 'user8', 'Court Lane', 72, '');
        $this->createTeam('Villarreal CF', 'user9', 'Ivy Lane', 79, '');
        $this->createTeam('Real Betis Balompié', 'user10', 'El Libertador (La Bombastico)', 78, '');
        $this->createTeam('Borussia Mönchengladbach', 'user11', 'BORUSSIA-PARK', 78, '');
        $this->createTeam('Torino', 'user12', 'O Dromo', 77, '');

        $this->createTeam("Arsenal", "user13", "Emirates", 80, '1.png');
        $this->createTeam("Manchester United", "user14", "Old Trafford", 82, '11.png');
        $this->createTeam("Bayern Munich", "user15", "Allianz Arena", 84, '21.png');
        $this->createTeam("Milan", "user16", "San Siro", 78, '47.png');
        $this->createTeam("Athletico Madrid", "user17", "Estadio Vicente Calderon", 81, '240.png');
        $this->createTeam('Olympique de Marseille', 'user18', 'Stade Velodrome', 70, '');
        $this->createTeam('Atalanta', 'user19', 'Stadio Classico', 76, '');
        $this->createTeam('Athletic Club de Bilbao', 'user20', 'Waldstadion (Fussballstadion)', 79, '');
        $this->createTeam('Crystal Palace', 'user21', 'Selhurst Park', 76, '');
        $this->createTeam('Aston Villa', 'user22', 'Villa Park', 73, '');
        $this->createTeam('RC Celta de Vigo', 'user23', 'Stadio Classico', 78, '');
        $this->createTeam('Stoke City', 'user24', 'Britannia Stadium (Stoke City Football Stadium)', 76, '');

        $this->createTeam("Tottenham Hotspur", "user25", "White Hart Lane", 80, '18.png');
        $this->createTeam("Roma", "user26", "Stadio Olimpico", 79, '52.png');
        $this->createTeam("Inter", "user27", "San Siro", 78, '44.png');
        $this->createTeam("Paris Saint-Germain", "user28", "Parc des Princes", 82, '73.pngs');
        $this->createTeam("Juventus", "user29", "Juventus Stadium", 81, '45.png');
        $this->createTeam('VfB Stuttgart', 'user30', 'Waldstadion (Fussballstadion)', 75, '');
        $this->createTeam('SV Werder Bremen', 'user31', 'Waldstadion (Fussballstadion)', 76, '');
        $this->createTeam('Watford', 'user32', 'Vicarage Road', 77, '');
        $this->createTeam('Celtic', 'user33', 'Eastpoint Arena (Football Ground)', 74, '');
        $this->createTeam('Girondins de Bordeaux', 'user34', 'Waldstadion (Fussballstadion)', 75, '');
        $this->createTeam('Sampdoria', 'user35', 'Stadion Europa (Generic Europe 2)', 75, '');
        $this->createTeam('Cagliari', 'user36', 'Stadion Neder', 73, '');

        $this->createTeam("Manchester City", "user37", "Etihad", 83, '10.png');
        $this->createTeam("Everton", "user38", "Goodison Park", 78, '7.png');
        $this->createTeam("Southampton", "user39", "Molton Road", 75, '17.png');
        $this->createTeam("FC Schalke", "user40", "Veltins-Arena", 77, '34.png');
        $this->createTeam("Valencia", "user41", "Mestalla", 77, '461.png');
        $this->createTeam('Deportivo Toluca', 'user42', 'Stadion Europa (Generic Europe 2)', 71, '');
        $this->createTeam('1. FC Köln', 'user43', 'Waldstadion (Fussballstadion)', 76, '');
        $this->createTeam('Swansea City', 'user44', 'Liberty Stadium', 75, '');
        $this->createTeam('LOSC Lille', 'user45', 'Waldstadion (Fussballstadion)', 74, '');
        $this->createTeam('Shakhtar Donetsk', 'user46', 'Donbass Arena', 77, '');
        $this->createTeam('PSV', 'user47', 'Waldstadion (Fussballstadion)', 75, '');
        $this->createTeam('SC Freiburg', 'user48', 'Ivy Lane', 73, '');

        $this->createTeam("Napoli", "user49", "Stadion Olympik", 78, '48.png');
        $this->createTeam("Lyon", "user50", "Stade Gerland", 75, '66.png');
        $this->createTeam("AS Monaco", "user51", "Euro Arena", 77, '69.png');
        $this->createTeam("Sport Lisbon", "user52", "Waldstadion", 77, '237.png');
        $this->createTeam("Ajax", "user53", "Amsterdam ArenA", 74, '245.png');
        $this->createTeam('West Bromwich Albion', 'user54', 'The Hawthorns', 76, '');
        $this->createTeam('New York Red Bulls', 'user55', 'Waldstadion (Fussballstadion)', 70, '');
        $this->createTeam('River Plate', 'user56', 'El Monumental', 75, '');
        $this->createTeam('Independiente', 'user57', 'El Libertador (La Bombastico)', 75, '');
        $this->createTeam('AS Saint-Étienne', 'user58', 'Ivy Lane', 76, '');
        $this->createTeam('Hertha BSC Berlin', 'user59', 'Olympiastadion', 77, '');
        $this->createTeam('LA Galaxy', 'user60', 'StubHub Center', 72, '');

        $this->createTeam("FC Porto", "user61", "Estadio de las Artes", 77, '236.png');
        $this->createTeam("Sunderland", "user62", "Eastpoint Arena", 74, '106.png');
        $this->createTeam("Bayer Leverkusen", "user63", "Stade Municipal", 77, '32.png');
        $this->createTeam("Galatasaray SK", "user64", "Waldstadion", 78, '325.png');
        $this->createTeam("Sporting CP", "user65", "Waldstadion", 75, '237.png');
        $this->createTeam('Bournemouth', 'user66', 'Vitality Stadium (Goldsands Stadium)', 76, '');
        $this->createTeam('SC Braga', 'user67', 'Stadio Classico', 76, '');
        $this->createTeam('Sassuolo', 'user68', 'Crown Lane', 75, '');
        $this->createTeam('Deportivo Alavés', 'user69', 'Stade Municipal', 75, '');
        $this->createTeam('Hannover 96', 'user70', 'Waldstadion (Fussballstadion)', 75, '');
        $this->createTeam('UD Las Palmas', 'user71', 'El Monumento (Estadio Latino)', 75, '');
        $this->createTeam('FC Augsburg', 'user72', 'Stadion Neder', 75, '');

        $this->createTeam("Lazio", "user73", "Stadio Olimpico", 78, '46.png');
        $this->createTeam("Norwich City", "user74", "Carrow Road", 71, '2.png');
        $this->createTeam("Newcastle United", "user75", "St James' Park", 76, '13.png');
        $this->createTeam("Hamburger SV", "user76", "Imtech Arena", 75, '28.png');
        $this->createTeam("Real Sociedad", "user77", "O Dromo", 77, '457.png');
        $this->createTeam("Huddersfield Town", "user78", "384", 74, '');
        $this->createTeam("Getafe CF", "user79", "Stadio Classico", 74, '');
        $this->createTeam("Wolverhampton Wanderers", "user80", "Ivy Lane", 74, '');
        $this->createTeam("RSC Anderlecht", "user81", "Stade Municipal", 74, '');
        $this->createTeam("FC Basel", "user82", "Stadion Europa (Generic Europe 2)", 73, '');
        $this->createTeam("FC Utrecht", "user83", "Ivy Lane", 72, '');
        $this->createTeam("Girona CF", "user84", "Stadio Classico", 75, '');

        $this->createTeam("Sevilla", "user85", "El Libertador", 76, '481.png');
        $this->createTeam('OGC Nice', 'user86', 'Test', 0, '72.png');
        $this->createTeam('RB Leipzig', 'user87', 'Test', 0, '112172.png');
        $this->createTeam('Malaga', 'user88', 'Test', 0, '573.png');
        $this->createTeam('Leicester City', 'user89', 'Test', 0, '95.png');
        $this->createTeam("Derby County", "user90", "Molton Road (Sheldon Stadium)", 72, '');
        $this->createTeam("Boca Juniors", "user91", "La Bombonera", 75, '');
        $this->createTeam("CD Leganés", "user92", "Stadion 23. Maj", 75, '');
        $this->createTeam("1. FSV Mainz 05", "user93", "Ivy Lane", 75, '');
        $this->createTeam("Brighton & Hove Albion", "user94", "340", 75, '');
        $this->createTeam("AEK Athens", "user95", "Stadion Olympik", 74, '');
        $this->createTeam("Toulouse FC", "user96", "Waldstadion (Fussballstadion)", 74, '');

        $manager->flush();
    }

    /**
     * @param string $name
     * @param string $username
     * @param string $stadiumName
     * @param int $rating
     * @param string $logo
     */
    private function createTeam(string $name, string $username, string $stadiumName,
                                int $rating, string $logo)
    {
        $stadium = $this->getStadiumByName($stadiumName);
        $user = $this->getUserByUsername($username);

        $team = new Team();
        $team->setName($name);
        $team->setRating($rating);
        $team->setStadium($stadium);
        $team->setUser($user);
        $team->setLogo($logo);

        $this->manager->persist($team);

        $this->addReference('team.'.$name, $team);
    }

    /**
     * @param string $name
     * @return Stadium
     */
    private function getStadiumByName($name)
    {
        return $this->getReference('stadium.'.$name);
    }

    /**
     * @param string  $username
     * @return User
     */
    private function getUserByUsername($username)
    {
        return $this->getReference('user.'.$username);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            StadiumFixtures::class,
            UserFixtures::class
        ];
    }
}