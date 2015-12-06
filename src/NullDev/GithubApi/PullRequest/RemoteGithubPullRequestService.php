<?php
namespace NullDev\GithubApi\PullRequest;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubPullRequestService.
 */
class RemoteGithubPullRequestService
{
    private $clientFactory;
    private $githubPullRequestDataFactory;

    /**
     * RemoteGithubPullRequestService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubPullRequestDataFactory        $githubPullRequestDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubPullRequestDataFactory $githubPullRequestDataFactory
    ) {
        $this->clientFactory                = $clientFactory;
        $this->githubPullRequestDataFactory = $githubPullRequestDataFactory;
    }

    /**
     * @param GithubRepoDataInterface        $githubRepo
     * @param GithubPullRequestDataInterface $githubPullRequest
     * @param User                           $user
     *
     * @return mixed
     */
    public function fetch(GithubRepoDataInterface $githubRepo, GithubPullRequestDataInterface $githubPullRequest, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('repository')->pullRequestes(
            $githubRepo->getOwner(),
            $githubRepo->getName(),
            $githubPullRequest->getName()
        );

        return $this->githubPullRequestDataFactory->create($remoteData);
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

        $remoteData = $client->api('repository')->pullRequestes(
            $githubRepo->getOwner(),
            $githubRepo->getName()
        );

        $results = [];

        foreach ($remoteData as $pullRequestRemoteData) {
            $remoteData = $client->api('repository')->pullRequestes(
                $githubRepo->getOwner(),
                $githubRepo->getName(),
                $pullRequestRemoteData['name']
            );

            $results[] = $this->githubPullRequestDataFactory->create($remoteData);
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
