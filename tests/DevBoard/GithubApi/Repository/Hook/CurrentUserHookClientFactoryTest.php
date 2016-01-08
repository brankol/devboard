<?php
namespace tests\DevBoard\GithubApi\Repository\Hook;

use Resources\PhpUnit\MyKernelTestCase;

/**
 * Class CurrentUserHookClientFactoryTest.
 */
class CurrentUserHookClientFactoryTest extends MyKernelTestCase
{
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->logUserIn();

        $this->service = $this->container->get('github.api.repo.hook.client.factory.current_user');
    }

    public function testHookClientFactoryAsServiceWork()
    {
        $this->assertInstanceOf('DevBoard\GithubApi\Repository\Hook\CurrentUserHookClientFactory', $this->service);
    }

    public function testCreate()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface')->reveal();

        $result = $this->service->create($githubRepo);

        $this->assertInstanceOf('DevBoard\GithubApi\Repository\Hook\HookClient', $result);
    }
}
