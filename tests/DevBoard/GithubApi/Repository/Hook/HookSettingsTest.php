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
        $this->assertInstanceOf('DevBoard\GithubApi\Repository\Hook\HookSettings', $this->service);
    }

    public function testReturningData()
    {
        $this->assertSame('web', $this->service->getName());

        $this->assertArrayHasKey('url', $this->service->getConfigParams());
        $this->assertArrayHasKey('content_type', $this->service->getConfigParams());
        $this->assertArrayHasKey('insecure_ssl', $this->service->getConfigParams());
        $this->assertArrayHasKey('secret', $this->service->getConfigParams());

        $this->assertSame(['push', 'pull_request', 'status'], $this->service->getEventParams());
    }
}
