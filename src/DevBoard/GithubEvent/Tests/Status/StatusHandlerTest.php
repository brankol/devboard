<?php
namespace DevBoard\GithubEvent\Tests\Status;

use DevBoard\GithubEvent\Payload\StatusPayload;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class StatusHandlerTest.
 */
class StatusHandlerTest extends WebTestCase
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
     * @dataProvider provideStatusEvents
     *
     * @param $data
     */
    public function testStatusEvents($data)
    {
        $payload            = new StatusPayload($data);
        $statusEventHandler = $this->container->get('github.event.status.handler');
        $result             = $statusEventHandler->process($payload);
        $this->assertTrue($result);
    }

    /**
     * @return array
     */
    public function provideStatusEvents()
    {
        return [
            [json_decode($this->getSampleFile('pending-status-circle-ci.json'), true)],
            [json_decode($this->getSampleFile('pending-status-travis-ci.json'), true)],
            [json_decode($this->getSampleFile('error-status-circle-ci.json'), true)],
            [json_decode($this->getSampleFile('error-status-travis-ci.json'), true)],
            [json_decode($this->getSampleFile('failure-status-circle-ci.json'), true)],
            [json_decode($this->getSampleFile('success-status-circle-ci.json'), true)],
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
