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
        self::assertInstanceOf(
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

        self::assertTrue(is_array($result));
    }

    /**
     * @group GitHubMutable
     */
    public function testFindHook()
    {
        $this->givenThereIsHook();
        $result = $this->provideAccessibleRepoTestClient()->findHook();

        self::assertNotFalse($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testFindHookNoneFound()
    {
        $this->givenThereIsNoHook();
        $result = $this->provideAccessibleRepoTestClient()->findHook();

        self::assertFalse($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testRemoveHook()
    {
        $this->givenThereIsHook();
        $result = $this->provideAccessibleRepoTestClient()->removeHook();

        self::assertTrue($result);
    }

    /**
     * @group GitHubMutable
     */
    public function testReadOnlyRepoWillThrowRunTimeExceptions()
    {
        $readOnlyClient = $this->service->create($this->provideReadOnlyRepo());

        $resultCreate = $readOnlyClient->createHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultCreate);

        $resultFind = $readOnlyClient->findHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultFind);

        $resultRemove = $readOnlyClient->removeHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultRemove);
    }

    /**
     * @group GitHubMutable
     */
    public function testUntouchableRepoWillThrowRunTimeExceptions()
    {
        $untochuableClient = $this->service->create($this->provideUntouchableRepo());

        $resultCreate = $untochuableClient->createHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultCreate);

        $resultFind = $untochuableClient->findHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultFind);

        $resultRemove = $untochuableClient->removeHook();
        self::assertInstanceOf('Github\Exception\RuntimeException', $resultRemove);
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
     * @return \NullDev\GithubApi\Repo\GithubRepoDataInterface
     */
    private function provideAccessibleRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('devboard');
        $githubRepo->getName()->willReturn('test-hitman');

        return $githubRepo->reveal();
    }

    /**
     * @return \NullDev\GithubApi\Repo\GithubRepoDataInterface
     */
    private function provideReadOnlyRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('devboard');
        $githubRepo->getName()->willReturn('test-assasin');

        return $githubRepo->reveal();
    }

    /**
     * @return \NullDev\GithubApi\Repo\GithubRepoDataInterface
     */
    private function provideUntouchableRepo()
    {
        $githubRepo = $this->getProphet()->prophesize('NullDev\GithubApi\Repo\GithubRepoDataInterface');
        $githubRepo->getOwner()->willReturn('msvrtan');
        $githubRepo->getName()->willReturn('test-untouchable');

        return $githubRepo->reveal();
    }
}
