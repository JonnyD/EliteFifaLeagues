<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Entity\Role;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Tests\TestHelper;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUsername()
    {
        $user = new User();
        $user->setUsername("user1");

        $this->assertEquals("user1", $user->getUsername());
    }

    public function testPassword()
    {
        $user = new User();
        $user->setPassword("pass1");

        $this->assertEquals("pass1", $user->getPassword());
    }

    public function testEmail()
    {
        $user = new User();
        $user->setEmail("my1@email.com");

        $this->assertEquals("my1@email.com", $user->getEmail());
    }

    public function testRoles()
    {
        $role = TestHelper::createRole("user", "ROLE_USER");
        $user = TestHelper::createUser("user1");
        $user->addRole($role);

        $this->assertEquals(1, count($user->getRoles()));
        $this->assertEquals("user", $user->getRoles()[0]->getName());
        $this->assertEquals("ROLE_USER", $user->getRoles()[0]->getRole());
    }

    public function testTeam()
    {
        $team = TestHelper::createTeam("Liverpool");
        $user = TestHelper::createUser("user1");
        $user->setTeam($team);

        $this->assertNotNull($user->getTeam());
        $this->assertEquals("Liverpool", $user->getTeam()->getName());
    }

    public function testTeamBidirectional()
    {
        $team = TestHelper::createTeam("Liverpool");
        $user = TestHelper::createUser("user1");
        $team->setUser($user);

        $this->assertNotNull($user->getTeam());
        $this->assertEquals("Liverpool", $user->getTeam()->getName());
    }

    public function testHomeMatches()
    {
        $liverpool = TestHelper::createTeam("liverpool");
        $chelsea = TestHelper::createTeam("chelsea");
        $arsenal = TestHelper::createTeam("arsenal");
        $manCity = TestHelper::createTeam("man city");

        $match1 = TestHelper::createMatch($liverpool, $chelsea);
        $match2 = TestHelper::createMatch($liverpool, $arsenal);
        $match3 = TestHelper::createMatch($liverpool, $manCity);

        $user = TestHelper::createUser("user1");
        $user->addHomeMatch($match1);
        $user->addHomeMatch($match2);
        $user->addHomeMatch($match3);

        $homeMatches = $user->getHomeMatches();

        $this->assertNotNull($homeMatches);
        $this->assertEquals(3, $homeMatches->count());
    }

    public function testHomeMatchesBidirectional()
    {
        $liverpool = TestHelper::createTeam("liverpool");
        $chelsea = TestHelper::createTeam("chelsea");
        $arsenal = TestHelper::createTeam("arsenal");
        $manCity = TestHelper::createTeam("man city");

        $match1 = TestHelper::createMatch($liverpool, $chelsea);
        $match2 = TestHelper::createMatch($liverpool, $arsenal);
        $match3 = TestHelper::createMatch($liverpool, $manCity);

        $user = TestHelper::createUser("user1");
        $user->addHomeMatch($match1);
        $user->addHomeMatch($match2);
        $user->addHomeMatch($match3);

        $homeMatches = $user->getHomeMatches();

        $this->assertNotNull($homeMatches);
        $this->assertEquals(3, $homeMatches->count());

        $chelseaMatch = $homeMatches[0];
        $this->assertNotNull($chelseaMatch);
        $this->assertEquals("user1", $chelseaMatch->getHomeUser()->getUsername());
    }
}