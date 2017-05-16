<?php

namespace EliteFifa\Bundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use EliteFifa\Bundle\Tests\BaseWebTestCase;
use EliteFifa\Bundle\Entity\User;

class RoleManagerTest extends BaseWebTestCase
{
    private $roleManager;

    public function setUp()
    {
        parent::setUp();

        $this->roleManager = $this->getContainer()->get("elite_fifa.role_manager");
    }

    public function testGetRoleByName()
    {
        $role = $this->roleManager->getRoleByName("user");
        $this->assertNotNull($role);
        $this->assertEquals("user", $role->getName());
        $this->assertEquals("ROLE_USER", $role->getRole());
    }

}