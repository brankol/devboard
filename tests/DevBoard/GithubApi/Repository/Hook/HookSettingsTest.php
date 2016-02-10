<?php
namespace tests\DevBoard\GithubApi\Repository\Hook;

use Resources\PhpUnit\MyKernelTestCase;

/**
 * Class HookSettingsTest.
 */
class HookSettingsTest extends MyKernelTestCase
{
    private $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->container->get('github.api.repo.hook.settings.basic');
    }

    public function testBasicHookSettingsAsServiceWork()
    {
        self::assertInstanceOf('DevBoard\GithubApi\Repository\Hook\HookSettings', $this->service);
    }

    public function testReturningData()
    {
        self::assertSame('web', $this->service->getName());

        self::assertArrayHasKey('url', $this->service->getConfigParams());
        self::assertArrayHasKey('content_type', $this->service->getConfigParams());
        self::assertArrayHasKey('insecure_ssl', $this->service->getConfigParams());
        self::assertArrayHasKey('secret', $this->service->getConfigParams());

        self::assertSame(['push', 'pull_request', 'status'], $this->service->getEventParams());
    }
}
