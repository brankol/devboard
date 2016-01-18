<?php
namespace tests\DevBoard\GithubApi\Repository\Hook;

use Resources\PhpUnit\MyKernelTestCase;

/**
 * Class HookClientTest.
 */
class HookClientTest extends MyKernelTestCase
{
    private $service;
    private $accessibleTestClient;

    public function setUp()
    {
        parent::setUp();

        $this->logUserIn();

        $this->service = $this->container->get('github.api.repo.hook.client.factory.current_user');
    }

    public function testFactoryWorks()
    {
        $this->assertInstanceOf(
            'DevBoard\GithubApi\Repository\Hook\HookClient',
            $this->provideAccessibleRepoTestClient()
        );
    }

    /**
     * @group GitHubMutable
     */
    public function testCreateHook()
    {
        $this->givenThereIsNoHook();

        $result = $this->provideAccessibleRepoTestClient()->createHook();

        $this->assertTrue(is_array($result));
    }

    /**
     * @group GitHubMutable
     */
    public function testFindHook()
    {
        $this->givenThereIsHook();
        $result = $this->provideAccessibleRepoTestClient()->findHook();

        $this->assertNotFalse($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testFindHookNoneFound()
    {
        $this->givenThereIsNoHook();
        $result = $this->provideAccessibleRepoTestClient()->findHook();

        $this->assertFalse($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testRemoveHook()
    {
        $this->givenThereIsHook();
        $result = $this->provideAccessibleRepoTestClient()->removeHook();

        $this->assertTrue($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testReadOnlyRepoWillThrowRunTimeExceptions()
    {
        $readOnlyClient = $this->service->create($this->provideReadOnlyRepo());

        $resultCreate = $readOnlyClient->createHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultCreate);

        $resultFind = $readOnlyClient->findHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultFind);

        $resultRemove = $readOnlyClient->removeHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultRemove);
    }

    /**
     * @group GitHubMutable
     */
    public function testUntouchableRepoWillThrowRunTimeExceptions()
    {
        $untochuableClient = $this->service->create($this->provideUntouchableRepo());

        $resultCreate = $untochuableClient->createHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultCreate);

        $resultFind = $untochuableClient->findHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultFind);

        $resultRemove = $untochuableClient->removeHook();
        $this->assertInstanceOf('Github\Exception\RuntimeException', $resultRemove);
    }

    protected function givenThereIsNoHook()
    {
        if (false !== $this->provideAccessibleRepoTestClient()->findHook()) {
            $this->provideAccessibleRepoTestClient()->removeHook();
        }
    }

    protected function givenThereIsHook()
    {
        if (false === $this->provideAccessibleRepoTestClient()->findHook()) {
            $this->provideAccessibleRepoTestClient()->createHook();
        }
    }

    private function provideAccessibleRepoTestClient()
    {
        if (null === $this->accessibleTestClient) {
            $this->accessibleTestClient = $this->service->create($this->provideAccessibleRepo());
        }

        return $this->accessibleTestClient;
    }

    /**
     * @return object
     */
    private function provideAccessibleRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('devboard');
        $githubRepo->getName()->willReturn('test-hitman');

        return $githubRepo->reveal();
    }

    /**
     * @return object
     */
    private function provideReadOnlyRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('devboard');
        $githubRepo->getName()->willReturn('test-assasin');

        return $githubRepo->reveal();
    }

    /**
     * @return object
     */
    private function provideUntouchableRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('msvrtan');
        $githubRepo->getName()->willReturn('test-untouchable');

        return $githubRepo->reveal();
    }
}
