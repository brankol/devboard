<?php
namespace NullDev\GithubApi\Client\Authenticated;

use NullDev\GithubApi\Client\ClientFactoryInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Interface AuthenticatedClientFactoryInterface.
 */
interface AuthenticatedClientFactoryInterface extends ClientFactoryInterface
{
    /**
     * @param User $user
     *
     * @return mixed
     */
    public function create(User $user);
}
