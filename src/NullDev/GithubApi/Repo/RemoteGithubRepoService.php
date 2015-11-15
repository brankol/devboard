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
    private $githubRepoDataFactory;

    /**
     * RemoteGithubRepoService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubRepoDataFactory               $githubRepoDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubRepoDataFactory $githubRepoDataFactory
    ) {
        $this->clientFactory         = $clientFactory;
        $this->githubRepoDataFactory = $githubRepoDataFactory;
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

        $remoteData = $client->api('repository')->show($githubRepo->getOwner(), $githubRepo->getName());

        return $this->githubRepoDataFactory->create($remoteData);
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
