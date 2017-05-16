<?php

namespace EliteFifa\Bundle\Tests\Manager;

use EliteFifa\Bundle\Tests\BaseWebTestCase;

class UserManagerTest extends BaseWebTestCase
{
    private $userManager;

    public function setUp()
    {
        parent::setUp();

        $this->userManager = $this->getContainer()->get("elite_fifa.user_manager");
    }

    public function testGetAllUsers()
    {
        $users = $this->userManager->getAllUsers();

        $this->assertNotNull($users);
        $this->assertEquals(4, count($users));
    }

    public function testGetLoggedInUser()
    {
        //TODO:
    }

    public function testGetUserByUsername()
    {
        $user = $this->userManager->getUserByUsername("user1");

        $this->assertNotNull($user);
        $this->assertEquals("user1", $user->getUsername());
    }

    public function testGetUserById()
    {
        $userId = $this->userManager->getUserByUsername("user1")->getId();
        $user = $this->userManager->getUserById($userId);

        $this->assertNotNull($user);
        $this->assertEquals("user1", $user->getUsername());
    }
}
