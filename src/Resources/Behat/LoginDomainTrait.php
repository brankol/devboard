<?php
namespace Resources\Behat;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Behat trait.
 */
trait LoginDomainTrait
{
    /**
     * @Given I am logged in as :username
     *
     * @param $username
     */
    public function iAmLoggedInAs($username)
    {
        $this->logUserIn($username);
    }

    /**
     * @param string $username
     *
     * @return mixed
     */
    private function loadUserByUsername($username)
    {
        return $this->getEntityManager()->getRepository('NullDevUserBundle:User')->findOneByUsername($username);
    }

    /**
     * @param User $user
     */
    private function logUserIn(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->getService('security.context')->setToken($token);
    }
}
