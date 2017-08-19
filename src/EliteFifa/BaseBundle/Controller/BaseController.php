<?php

namespace EliteFifa\BaseBundle\Controller;

use EliteFifa\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class BaseController extends Controller
{
    /**
     * @return User
     */
    protected function getLoggedInUser()
    {
        return $this->getSecurityTokenStorage()->getToken()->getUser();
    }

    /**
     * @return TokenStorage
     */
    private function getSecurityTokenStorage()
    {
        return $this->get('security.token_storage');
    }
}