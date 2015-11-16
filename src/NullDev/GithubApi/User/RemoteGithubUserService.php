<?php
namespace NullDev\GithubApi\User;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubUserService.
 */
class RemoteGithubUserService
{
    private $clientFactory;
    private $githubUserDataFactory;

    /**
     * RemoteGithubRepoService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubUserDataFactory               $githubUserDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubUserDataFactory $githubUserDataFactory
    ) {
        $this->clientFactory         = $clientFactory;
        $this->githubUserDataFactory = $githubUserDataFactory;
    }

    /**
     * @param GithubUserDataInterface $githubUser
     * @param User                    $user
     *
     * @return mixed
     */
    public function fetch(GithubUserDataInterface $githubUser, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('user')->show($githubUser->getUsername());

        return $this->githubUserDataFactory->create($remoteData);
    }

    /**
     * @param User $user
     *
     * @return \Github\Client
     */
    private function createClient(User $user)
    {
        return $this->clientFactory->create($user);
    }
}
