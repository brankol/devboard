<?php
namespace NullDev\GithubApi\Branch;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubBranchService.
 */
class RemoteGithubBranchService
{
    private $clientFactory;
    private $githubBranchDataFactory;

    /**
     * RemoteGithubBranchService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubBranchDataFactory             $githubBranchDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubBranchDataFactory $githubBranchDataFactory
    ) {
        $this->clientFactory           = $clientFactory;
        $this->githubBranchDataFactory = $githubBranchDataFactory;
    }

    /**
     * @param GithubRepoDataInterface   $githubRepo
     * @param GithubBranchDataInterface $githubBranch
     * @param User                      $user
     *
     * @return mixed
     */
    public function fetch(GithubRepoDataInterface $githubRepo, GithubBranchDataInterface $githubBranch, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('repository')->branches(
            $githubRepo->getOwner(),
            $githubRepo->getName(),
            $githubBranch->getName()
        );

        return $this->githubBranchDataFactory->create($remoteData);
    }

    /**
     * @param GithubRepoDataInterface $githubRepo
     * @param User                    $user
     *
     * @return array
     */
    public function fetchAll(GithubRepoDataInterface $githubRepo, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('repository')->branches(
            $githubRepo->getOwner(),
            $githubRepo->getName()
        );

        $results = [];

        foreach ($remoteData as $branchRemoteData) {
            $remoteData = $client->api('repository')->branches(
                $githubRepo->getOwner(),
                $githubRepo->getName(),
                $branchRemoteData['name']
            );

            $results[] = $this->githubBranchDataFactory->create($remoteData);
        }

        return $results;
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
