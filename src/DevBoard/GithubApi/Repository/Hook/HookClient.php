<?php
namespace DevBoard\GithubApi\Repository\Hook;

use Exception;
use Github\Client;
use Github\Exception\ValidationFailedException;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;

/**
 * Class HookClient.
 */
class HookClient
{
    protected $client;
    protected $hookSettings;
    protected $githubRepo;

    /**
     * HookClient constructor.
     *
     * @param Client                  $client
     * @param HookSettings            $hookSettings
     * @param GithubRepoDataInterface $githubRepo
     */
    public function __construct(
        Client $client,
        HookSettings $hookSettings,
        GithubRepoDataInterface $githubRepo
    ) {
        $this->client       = $client;
        $this->hookSettings = $hookSettings;
        $this->githubRepo   = $githubRepo;
    }

    /**
     * @return Exception|ValidationFailedException|\Guzzle\Http\EntityBodyInterface|mixed|string
     */
    public function createHook()
    {
        try {
            $result = $this->getHooks()->create(
                $this->getOwner(),
                $this->getName(),
                $this->hookSettings->getCreateHookParams()
            );
        } catch (ValidationFailedException $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

        return $result;
    }

    /**
     * @return bool|Exception|ValidationFailedException
     */
    public function findHook()
    {
        try {
            $result = $this->getHooks()->all($this->getOwner(), $this->getName());
        } catch (ValidationFailedException $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }
        foreach ($result as $hook) {
            if (array_key_exists('url', $hook['config'])) {
                if ($hook['config']['url'] === $this->hookSettings->getUrl()) {
                    return $hook['id'];
                }
            }
        }

        return false;
    }

    /**
     * @return bool|Exception|ValidationFailedException
     */
    public function removeHook()
    {
        $hookId = $this->findHook();

        if (false === $hookId) {
            return false;
        }

        try {
            $this->getHooks()->remove($this->getOwner(), $this->getName(), $hookId);
        } catch (ValidationFailedException $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

        return true;
    }

    /**
     * @return \Github\Api\Repository\Hooks
     */
    private function getHooks()
    {
        return $this->client->repo()->hooks();
    }

    private function getOwner()
    {
        return $this->githubRepo->getOwner();
    }

    private function getName()
    {
        return $this->githubRepo->getName();
    }
}
