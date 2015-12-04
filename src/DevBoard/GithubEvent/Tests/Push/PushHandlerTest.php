<?php
namespace DevBoard\GithubEvent\Tests\Push;

use DevBoard\GithubEvent\Payload\PushPayload;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PushHandlerTest extends WebTestCase
{
    protected $container;

    public function setUp()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        $this->container = $kernel->getContainer();
    }

    /**
     * @dataProvider provideCreatedBranch
     */
    public function testPushEventToCreateNewBranch($data)
    {
        $payload          = new PushPayload($data);
        $pushEventHandler = $this->container->get('github.event.push.handler');
        $result           = $pushEventHandler->process($payload);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider provideUpdatedBranch
     */
    public function testPushEventToUpdateBranch($data)
    {
        $payload          = new PushPayload($data);
        $pushEventHandler = $this->container->get('github.event.push.handler');
        $result           = $pushEventHandler->process($payload);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider provideDeletedBranch
     */
    public function testPushEventToDeleteBranch($data)
    {
        $payload          = new PushPayload($data);
        $pushEventHandler = $this->container->get('github.event.push.handler');
        $result           = $pushEventHandler->process($payload);
        $this->assertTrue($result);
    }

    /**
     * @return array
     */
    public function provideCreatedBranch()
    {
        return [
            [json_decode($this->getSampleFile('created-branch.json'), true)],
        ];
    }

    /**
     * @return array
     */
    public function provideUpdatedBranch()
    {
        return [
            [json_decode($this->getSampleFile('updated-branch.json'), true)],
        ];
    }

    /**
     * @return array
     */
    public function provideDeletedBranch()
    {
        return [
            [json_decode($this->getSampleFile('deleted-branch.json'), true)],
        ];
    }

    /**
     * @param $filename
     *
     * @return string
     */
    private function getSampleFile($filename)
    {
        return file_get_contents(__DIR__.'/../sample-data/'.$filename);
    }
}
