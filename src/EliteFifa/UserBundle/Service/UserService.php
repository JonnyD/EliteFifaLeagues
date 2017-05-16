<?php

namespace EliteFifa\UserBundle\Service;

use EliteFifa\UserBundle\Entity\Role;
use EliteFifa\UserBundle\Repository\UserRepository;
use EliteFifa\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\SecurityContext;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function getLoggedInUser()
    {
        return $this->securityContext->getToken()->getUser();
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function getUserByUsername($username)
    {
        return $this->userRepository->findOneByUsername($username);
    }
}