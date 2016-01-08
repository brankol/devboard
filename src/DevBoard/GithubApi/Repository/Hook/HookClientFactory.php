<?php
namespace DevBoard\GithubApi\Repository\Hook;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;

/**
 * Class HookClientFactory.
 */
class HookClientFactory
{
    private $clientFactory;
    private $hookSettings;

    /**
     * HookClientFactory constructor.
     *
     * @param AuthenticatedClientFactoryInterface              $clientFactory
     * @param \DevBoard\GithubApi\Repository\Hook\HookSettings $hookSettings
     */
    public function __construct(AuthenticatedClientFactoryInterface $clientFactory, HookSettings $hookSettings)
    {
        $this->clientFactory = $clientFactory;
        $this->hookSettings  = $hookSettings;
    }

    /**
     * @param GithubRepoDataInterface $githubRepo
     * @param User                    $user
     *
     * @return HookClient
     */
    public function create(GithubRepoDataInterface $githubRepo, User $user)
    {
        $client = $this->clientFactory->create($user);

        return new HookClient($client, $this->hookSettings, $githubRepo);
    }
}
