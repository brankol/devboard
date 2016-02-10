<?php
namespace tests\DevBoard\GithubApi\Repository\Hook;

use Resources\PhpUnit\MyKernelTestCase;

/**
 * Class HookClientFactoryTest.
 */
class HookClientFactoryTest extends MyKernelTestCase
{
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = $this->container->get('github.api.repo.hook.client.factory');
    }

    public function testHookClientFactoryAsServiceWork()
    {
        self::assertInstanceOf('DevBoard\GithubApi\Repository\Hook\HookClientFactory', $this->service);
    }

    public function testCreate()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface')->reveal();
        $user       = $this->getProphet()->prophesize('NullDev\UserBundle\Entity\User')->reveal();

        $result = $this->service->create($githubRepo, $user);

        self::assertInstanceOf('DevBoard\GithubApi\Repository\Hook\HookClient', $result);
    }
}
