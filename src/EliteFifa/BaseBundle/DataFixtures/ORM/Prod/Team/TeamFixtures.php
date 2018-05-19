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
        $this->createTeam('Parma', "user41", "Arena d'Oro", 70, '');

        $this->createTeam("Arsenal", "user6", "Emirates", 80, '1.png');
        $this->createTeam("Manchester United", "user7", "Old Trafford", 82, '11.png');
        $this->createTeam("Bayern Munich", "user8", "Allianz Arena", 84, '21.png');
        $this->createTeam("Milan", "user9", "San Siro", 78, '47.png');
        $this->createTeam("Athletico Madrid", "user10", "Estadio Vicente Calderon", 81, '240.png');
        $this->createTeam('Olympique de Marseille ', 'user42', 'Stade Velodrome', 70, '');

        $this->createTeam("Tottenham Hotspur", "user11", "White Hart Lane", 80, '18.png');
        $this->createTeam("Roma", "user12", "Stadio Olimpico", 79, '52.png');
        $this->createTeam("Inter", "user13", "San Siro", 78, '44.png');
        $this->createTeam("Paris Saint-Germain", "user14", "Parc des Princes", 82, '73.pngs');
        $this->createTeam("Juventus", "user15", "Juventus Stadium", 81, '45.png');
        $this->createTeam('VfB Stuttgart', 'user43', 'Waldstadion (Fussballstadion)', 75, '');

        $this->createTeam("Manchester City", "user16", "Etihad", 83, '10.png');
        $this->createTeam("Everton", "user17", "Goodison Park", 78, '7.png');
        $this->createTeam("Southampton", "user18", "Molton Road", 75, '17.png');
        $this->createTeam("FC Schalke", "user19", "Veltins-Arena", 77, '34.png');
        $this->createTeam("Valencia", "user20", "Mestalla", 77, '461.png');

        $this->createTeam("Napoli", "user21", "Stadion Olympik", 78, '48.png');
        $this->createTeam("Lyon", "user22", "Stade Gerland", 75, '66.png');
        $this->createTeam("AS Monaco", "user23", "Euro Arena", 77, '69.png');
        $this->createTeam("Sport Lisbon", "user24", "Waldstadion", 77, '237.png');
        $this->createTeam("Ajax", "user25", "Amsterdam ArenA", 74, '245.png');

        $this->createTeam("FC Porto", "user26", "Estadio de las Artes", 77, '236.png');
        $this->createTeam("Sunderland", "user27", "Eastpoint Arena", 74, '106.png');
        $this->createTeam("Bayer Leverkusen", "user28", "Stade Municipal", 77, '32.png');
        $this->createTeam("Galatasaray", "user29", "Waldstadion", 78, '325.png');
        $this->createTeam("Sporting CP", "user30", "Waldstadion", 75, '237.png');

        $this->createTeam("Lazio", "user31", "Stadio Olimpico", 78, '46.png');
        $this->createTeam("Aston Villa", "user32", "Forest Park Stadium", 74, '2.png');
        $this->createTeam("Newcastle United", "user33", "St James' Park", 76, '13.png');
        $this->createTeam("Hamburger SV", "user34", "Imtech Arena", 75, '28.png');
        $this->createTeam("Real Sociedad", "user35", "O Dromo", 77, '457.png');

        $this->createTeam("Sevilla", "user36", "El Libertador", 76, '481.png');
        $this->createTeam('OGC Nice', 'user37', 'Test', 0, '72.png');
        $this->createTeam('RB Leipzig', 'user38', 'Test', 0, '112172.png');
        $this->createTeam('Malaga', 'user39', 'Test', 0, '573.png');
        $this->createTeam('Leicester City', 'user40', 'Test', 0, '95.png');

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