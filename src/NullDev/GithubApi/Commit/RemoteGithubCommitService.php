<?php
namespace NullDev\GithubApi\Commit;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubCommitService.
 */
class RemoteGithubCommitService
{
    private $clientFactory;
    private $githubCommitDataFactory;

    /**
     * RemoteGithubCommitService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubCommitDataFactory             $githubCommitDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubCommitDataFactory $githubCommitDataFactory
    ) {
        $this->clientFactory           = $clientFactory;
        $this->githubCommitDataFactory = $githubCommitDataFactory;
    }

    /**
     * @param GithubCommitDataInterface $githubCommit
     * @param GithubRepoDataInterface   $githubRepo
     * @param User                      $user
     *
     * @return mixed
     */
    public function fetch(GithubCommitDataInterface $githubCommit, GithubRepoDataInterface $githubRepo, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('repository')->commits()->show(
            $githubRepo->getOwner(),
            $githubRepo->getName(),
            $githubCommit->getSha()
        );

        return $this->githubCommitDataFactory->create($githubRepo, $remoteData);
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
