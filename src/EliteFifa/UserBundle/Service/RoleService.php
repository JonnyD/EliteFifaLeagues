<?php

namespace EliteFifa\UserBundle\Service;

use EliteFifa\UserBundle\Entity\Role;
use EliteFifa\UserBundle\Repository\RoleRepository;
use Doctrine\ORM\EntityManager;

class RoleService
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function createRole($name, $roleType)
    {
        $role = new Role();
        $role->setName($name);
        $role->setRole($roleType);
        $this->persistAndFlush($role);
        return $role;
    }

    public function getRoleByName($name)
    {
        return $this->roleRepository->findOneByName($name);
    }

}