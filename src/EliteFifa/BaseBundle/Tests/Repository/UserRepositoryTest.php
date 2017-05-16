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
use EliteFifa\Bundle\Entity\User;

class UserRepositoryTest extends BaseWebTestCase
{
    private $userRepository;

    public function setUp()
    {
        parent::setUp();

        $this->userRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:User');
    }

    public function testFindAll()
    {
        $users = $this->userRepository->findAll();
        $this->assertNotNull($users);
        $this->assertTrue(is_array($users));
        $this->assertEquals(4, count($users));
    }

    public function testFindOneById()
    {
        $user = $this->userRepository->find(1);
        $this->assertNotNull($user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals("user1", $user->getUsername());
        $this->assertEquals("my1@email.com", $user->getEmail());
    }

    public function testFindOneByUsername()
    {
        $user = $this->userRepository->findOneByUsername("user1");
        $this->assertNotNull($user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals("user1", $user->getUsername());
        $this->assertEquals("my1@email.com", $user->getEmail());
    }

    public function testFindOneByEmail()
    {
        $email = "my1@email.com";
        $user = $this->userRepository->findOneByEmail($email);
        $this->assertNotNull($user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals("user1", $user->getUsername());
        $this->assertEquals($email, $user->getEmail());
    }

    public function testFindRolesByUser()
    {
        $user = $this->userRepository->findOneByUsername("user1");
        $this->assertNotNull($user);
        $this->assertEquals("user1", $user->getUsername());

        $roles = $user->getRoles();
        $this->assertNotNull($roles);
        $this->assertTrue(is_array($roles));
        $this->assertEquals(1, count($roles));

        $role = $roles[0];
        $this->assertNotNull($role);
        $this->assertEquals("user", $role->getName());
        $this->assertEquals("ROLE_USER", $role->getRole());
    }
}