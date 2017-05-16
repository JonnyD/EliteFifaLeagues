<?php

namespace EliteFifa\Bundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use EliteFifa\Bundle\Tests\BaseWebTestCase;
use EliteFifa\Bundle\Entity\Role;

class RoleRepositoryTest extends BaseWebTestCase
{
    private $roleRepository;

    public function setUp()
    {
        parent::setUp();

        $this->roleRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Role');
    }

    public function testFindAll()
    {
        $roles = $this->roleRepository->findAll();
        $this->assertNotNull($roles);
        $this->assertTrue(is_array($roles));
        $this->assertEquals(2, count($roles));
    }

    public function testFindOneById()
    {
        $userRole = $this->roleRepository->find(1);
        $this->assertNotNull($userRole);
        $this->assertEquals(1, $userRole->getId());
        $this->assertEquals("user", $userRole->getName());
        $this->assertEquals("ROLE_USER", $userRole->getRole());

        $adminRole = $this->roleRepository->find(2);
        $this->assertNotNull($adminRole);
        $this->assertEquals(2, $adminRole->getId());
        $this->assertEquals("admin", $adminRole->getName());
        $this->assertEquals("ROLE_ADMIN", $adminRole->getRole());
    }

    public function testFindOneByName()
    {
        $userRole = $this->roleRepository->findOneByName("user");
        $this->assertNotNull($userRole);
        $this->assertEquals("user", $userRole->getName());
        $this->assertEquals("ROLE_USER", $userRole->getRole());

        $adminRole = $this->roleRepository->findOneByName("admin");
        $this->assertNotNull($adminRole);
        $this->assertEquals("admin", $adminRole->getName());
        $this->assertEquals("ROLE_ADMIN", $adminRole->getRole());
    }

    public function testFindOneByRole()
    {
        $userRole = $this->roleRepository->findOneByRole("ROLE_USER");
        $this->assertNotNull($userRole);
        $this->assertEquals("user", $userRole->getName());
        $this->assertEquals("ROLE_USER", $userRole->getRole());

        $adminRole = $this->roleRepository->findOneByRole("ROLE_ADMIN");
        $this->assertNotNull($adminRole);
        $this->assertEquals("admin", $adminRole->getName());
        $this->assertEquals("ROLE_ADMIN", $adminRole->getRole());
    }

    public function testFindUsersByRole()
    {
        $role = $this->roleRepository->findOneByName("user");
        $this->assertNotNull($role);
        $this->assertEquals("user", $role->getName());

        $users = $role->getUsers();
        $this->assertNotNull($users);
        $this->assertTrue(is_array($users->toArray()));
        $this->assertEquals(1, count($users));
    }
}