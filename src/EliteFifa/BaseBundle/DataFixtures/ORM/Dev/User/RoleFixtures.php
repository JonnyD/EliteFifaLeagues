<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Dev\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EliteFifa\UserBundle\Entity\Role;

class RoleFixtures extends AbstractFixture implements ContainerAwareInterface
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

        $this->createRole("user", "ROLE_USER");
        $this->createRole("admin", "ROLE_ADMIN");

        $manager->flush();
    }

    /**
     * @param $name
     * @param $role
     */
    private function createRole($name, $role)
    {
        $roleEntity = new Role();
        $roleEntity->setName($name);
        $roleEntity->setRole($role);

        $this->manager->persist($roleEntity);

        $this->addReference('role.'.$name, $roleEntity);
    }
}