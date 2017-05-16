<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Role;
use EliteFifa\Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleTest extends WebTestCase
{
    public function testName()
    {
        $role = new Role();
        $role->setName("user");

        $this->assertEquals("user", $role->getName());
    }

    public function testRole()
    {
        $role = new Role();
        $role->setRole("ROLE_USER");

        $this->assertEquals("ROLE_USER", $role->getRole());
    }

    public function testUsers()
    {
        $user1 = new User();
        $user1->setUsername("user1");

        $user2 = new User();
        $user2->setUsername("user2");

        $user3 = new User();
        $user3->setUsername("user3");

        $role = new Role();
        $role->addUser($user1);
        $role->addUser($user2);
        $role->addUser($user3);

        $this->assertEquals(3, count($role->getUsers()));
        $this->assertEquals("user1", $role->getUsers()[0]->getUsername());
        $this->assertEquals("user2", $role->getUsers()[1]->getUsername());
        $this->assertEquals("user3", $role->getUsers()[2]->getUsername());
    }
}