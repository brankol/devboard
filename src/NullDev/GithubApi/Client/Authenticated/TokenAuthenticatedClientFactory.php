<?php
namespace NullDev\GithubApi\Client\Authenticated;

use Github\Client;
use NullDev\UserBundle\Entity\User;

/**
 * Class TokenAuthenticatedClientFactory.
 */
class TokenAuthenticatedClientFactory implements AuthenticatedClientFactoryInterface
{
    /**
     * @param User $user
     *
     * @return Client
     */
    public function create(User $user)
    {
        $client = new Client();
        $client->authenticate($user->getGithubAccessToken(), 'null', 'url_token');

        return $client;
    }
}
