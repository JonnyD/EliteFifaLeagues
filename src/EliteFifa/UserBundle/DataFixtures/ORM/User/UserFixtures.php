<?php

namespace EliteFifa\UserBundle\DataFixtures\ORM\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\UserBundle\Entity\Role;
use EliteFifa\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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

        $userRole = 'ROLE_USER';
        $adminRole = 'ROLE_ADMIN';

        for ($i = 1; $i <= 40; $i++) {
            if ($i == 1) {
                $this->createUser($adminRole, $i);
            } else {
                $this->createUser($userRole, $i);
            }
        }

        $manager->flush();
    }

    /**
     * @param Role $role
     * @param $number
     */
    private function createUser($role, $number)
    {
        $username = "user".$number;
        $email = $username."@email.com";
        $password = "pass".$number;

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $user->addRole($role);

        $this->manager->persist($user);

        $this->addReference('user.'.$username, $user);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return  [
            'EliteFifa\UserBundle\DataFixtures\ORM\User\RoleFixtures'
        ];
    }
}