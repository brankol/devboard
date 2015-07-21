<?php
namespace NullDev\UserBundle\Service;

use Exception;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CurrentUserService
{
    protected $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @throws Exception
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\TokenInterface
     */
    protected function getToken()
    {
        $token = $this->tokenStorage->getToken();

        if (null === $token) {
            throw new Exception('No security token');
        }

        return $token;
    }

    /**
     * @throws Exception
     *
     * @return \NullDev\UserBundle\Entity\User
     */
    public function getUser()
    {
        $user = $this->getToken()->getUser();

        if (!is_object($user)) {
            throw new Exception('No user in token');
        }

        return $user;
    }
}
