<?php

namespace EliteFifa\MatchBundle\DataFixtures\ORM\Match;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\MatchBundle\Entity\EventType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EventTypeFixtures extends AbstractFixture implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $goal = $this->createEventType("Goal");
        $mom = $this->createEventType("MOM");
        $cleanSheet = $this->createEventType("Clean Sheet");
        $yellowCard = $this->createEventType("Yellow Card");
        $redCard = $this->createEventType("Red Card");

        $manager->persist($goal);
        $manager->persist($mom);
        $manager->persist($cleanSheet);
        $manager->persist($yellowCard);
        $manager->persist($redCard);

        $this->addReference('match.event-type.goal', $goal);
        $this->addReference('match.event-type.mom', $mom);
        $this->addReference('match.event-type.clean-sheet', $cleanSheet);
        $this->addReference('match.event-type.yellow-card', $yellowCard);
        $this->addReference('match.event-type.red-card', $redCard);

        $manager->flush();
    }

    private function createEventType($name)
    {
        $eventType = new EventType();
        $eventType->setName($name);
        return $eventType;
    }
}