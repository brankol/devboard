<?php
namespace DevBoard\GithubApi\Repository\Hook;

use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Service\CurrentUserService;

/**
 * Class HookClientFactory.
 */
class CurrentUserHookClientFactory
{
    private $clientFactory;
    private $hookSettings;
    private $currentUserService;

    private $client;

    /**
     * CurrentUserHookClientFactory constructor.
     *
     * @param AuthenticatedClientFactoryInterface $clientFactory
     * @param HookSettings                        $hookSettings
     * @param CurrentUserService                  $currentUserService
     */
    public function __construct(
        AuthenticatedClientFactoryInterface $clientFactory,
        HookSettings $hookSettings,
        CurrentUserService $currentUserService
    ) {
        $this->clientFactory      = $clientFactory;
        $this->hookSettings       = $hookSettings;
        $this->currentUserService = $currentUserService;
    }

    /**
     * @param GithubRepoDataInterface $githubRepo
     *
     * @return HookClient
     */
    public function create(GithubRepoDataInterface $githubRepo)
    {
        return new HookClient($this->getClient(), $this->hookSettings, $githubRepo);
    }

    /**
     * @throws \Exception
     *
     * @return mixed
     */
    private function getClient()
    {
        if (null === $this->client) {
            $this->client = $this->clientFactory->create($this->currentUserService->getUser());
        }

        return $this->client;
    }
}
