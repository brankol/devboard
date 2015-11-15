<?php
namespace NullDev\GithubApi\Repo;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubRepoService.
 */
class RemoteGithubRepoService
{
    private $clientFactory;

    /**
     * RemoteGithubRepoService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     */
    public function __construct(AuthenticatedClientFactoryInterface $clientFactory)
    {
        $this->clientFactory = $clientFactory;
    }

    /**
     * @param GithubRepoDataInterface $githubRepo
     * @param User                    $user
     *
     * @return mixed
     */
    public function fetch(GithubRepoDataInterface $githubRepo, User $user)
    {
        $client = $this->createClient($user);

        return $client->api('repository')->show($githubRepo->getOwner(), $githubRepo->getName());
    }

    /**
     * @param User $user
     *
     * @return Client
     */
    private function createClient(User $user)
    {
        return $this->clientFactory->create($user);
    }
}
