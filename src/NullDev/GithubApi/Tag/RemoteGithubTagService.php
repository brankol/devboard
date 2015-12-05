<?php
namespace NullDev\GithubApi\Tag;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class RemoteGithubTagService.
 */
class RemoteGithubTagService
{
    private $clientFactory;
    private $githubTagDataFactory;

    /**
     * RemoteGithubTagService constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param GithubTagDataFactory                $githubTagDataFactory
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        GithubTagDataFactory $githubTagDataFactory
    ) {
        $this->clientFactory        = $clientFactory;
        $this->githubTagDataFactory = $githubTagDataFactory;
    }

    /**
     * @param GithubRepoDataInterface $githubRepo
     * @param GithubTagDataInterface  $githubTag
     * @param User                    $user
     *
     * @return mixed
     */
    public function fetch(GithubRepoDataInterface $githubRepo, GithubTagDataInterface $githubTag, User $user)
    {
        $client = $this->createClient($user);

        $remoteData = $client->api('repository')->tages(
            $githubRepo->getOwner(),
            $githubRepo->getName(),
            $githubTag->getName()
        );

        return $this->githubTagDataFactory->create($remoteData);
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

        $remoteData = $client->api('repository')->tages(
            $githubRepo->getOwner(),
            $githubRepo->getName()
        );

        $results = [];

        foreach ($remoteData as $tagRemoteData) {
            $remoteData = $client->api('repository')->tages(
                $githubRepo->getOwner(),
                $githubRepo->getName(),
                $tagRemoteData['name']
            );

            $results[] = $this->githubTagDataFactory->create($remoteData);
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
