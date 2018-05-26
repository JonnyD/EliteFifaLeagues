<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Stadium;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EliteFifa\StadiumBundle\Entity\Stadium;

class StadiumFixtures extends AbstractFixture implements ContainerAwareInterface
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

        $this->createStadium("Anfield");
        $this->createStadium("Santiago Bernabéu");
        $this->createStadium("Signal Iduna Park");
        $this->createStadium("Stamford Bridge");
        $this->createStadium("Camp Nou");
        $this->createStadium("Emirates");
        $this->createStadium("Old Trafford");
        $this->createStadium("Allianz Arena");
        $this->createStadium("San Siro");
        $this->createStadium("Estadio Vicente Calderon");
        $this->createStadium("White Hart Lane");
        $this->createStadium("Stadio Olimpico");
        $this->createStadium("Parc des Princes");
        $this->createStadium("Juventus Stadium");
        $this->createStadium("Etihad");
        $this->createStadium("Goodison Park");
        $this->createStadium("Molton Road");
        $this->createStadium("Veltins-Arena");
        $this->createStadium("Mestalla");
        $this->createStadium("Stadion Olympik");
        $this->createStadium("Stade Gerland");
        $this->createStadium("Euro Arena");
        $this->createStadium("Waldstadion");
        $this->createStadium("Amsterdam ArenA");
        $this->createStadium("Estadio de las Artes");
        $this->createStadium("Eastpoint Arena");
        $this->createStadium("Stade Municipal");
        $this->createStadium("Forest Park Stadium");
        $this->createStadium("St James' Park");
        $this->createStadium("Imtech Arena");
        $this->createStadium("O Dromo");
        $this->createStadium("El Libertador");
        $this->createStadium("Arena d'Oro");
        $this->createStadium('Stade Velodrome');
        $this->createStadium('Waldstadion (Fussballstadion)');
        $this->createStadium('Turf Moor');
        $this->createStadium('Court Lane');
        $this->createStadium('Ivy Lane');
        $this->createStadium('BORUSSIA-PARK');
        $this->createStadium('Selhurst Park');
        $this->createStadium('Villa Park');
        $this->createStadium('Stadio Classico');
        $this->createStadium('Britannia Stadium (Stoke City Football Stadium)');
        $this->createStadium('Vicarage Road');
        $this->createStadium('Eastpoint Arena (Football Ground)');
        $this->createStadium('Stadion Europa (Generic Europe 2)');
        $this->createStadium('Liberty Stadium');
        $this->createStadium('Donbass Arena');
        $this->createStadium('The Hawthorns');
        $this->createStadium('El Libertador (La Bombastico)');
        $this->createStadium('Olympiastadion');
        $this->createStadium('StubHub Center');
        $this->createStadium('Vitality Stadium (Goldsands Stadium)');
        $this->createStadium('Crown Lane');
        $this->createStadium('El Monumento (Estadio Latino)');
        $this->createStadium('Stadion Neder');
        $this->createStadium("La Bombonera");
        $this->createStadium("Stadion 23. Maj");
        $this->createStadium("340");
        $this->createStadium("384");
        $this->createStadium("Molton Road (Sheldon Stadium)");
        $this->createStadium('Test');
        $this->createStadium("El Monumental");
        $this->createStadium("Carrow Road");
        $manager->flush();
    }

    /**
     * @param string $name
     */
    private function createStadium($name)
    {
        $stadium = new Stadium();
        $stadium->setName($name);

        $this->manager->persist($stadium);

        $this->addReference('stadium.'.$name, $stadium);
    }
}