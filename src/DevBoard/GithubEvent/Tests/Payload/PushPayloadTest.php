<?php
namespace DevBoard\GithubEvent\Tests\Payload;

use DevBoard\GithubEvent\Payload\PushPayload;

/**
 * Class PushPayloadTest.
 */
class PushPayloadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideCreatedBranch
     *
     * @param $data
     *
     * @throws \Exception
     */
    public function testCreateBranch($data)
    {
        $payload = new PushPayload($data);

        $this->assertTrue($payload->isBranch());
        $this->assertTrue($payload->isCreate());
        $this->assertSame(PushPayload::CREATED, $payload->getType());

        $this->assertFalse($payload->isTag());
        $this->assertFalse($payload->isUpdate());
        $this->assertFalse($payload->isDelete());
    }

    /**
     * @dataProvider provideUpdatedBranch
     *
     * @param $data
     *
     * @throws \Exception
     */
    public function testUpdateBranch($data)
    {
        $payload = new PushPayload($data);

        $this->assertTrue($payload->isBranch());
        $this->assertTrue($payload->isUpdate());
        $this->assertSame(PushPayload::UPDATED, $payload->getType());

        $this->assertFalse($payload->isTag());
        $this->assertFalse($payload->isCreate());
        $this->assertFalse($payload->isDelete());
    }

    /**
     * @dataProvider provideDeletedBranch
     *
     * @param $data
     *
     * @throws \Exception
     */
    public function testDeleteBranch($data)
    {
        $payload = new PushPayload($data);

        $this->assertTrue($payload->isBranch());
        $this->assertTrue($payload->isDelete());
        $this->assertSame(PushPayload::DELETED, $payload->getType());

        $this->assertFalse($payload->isTag());
        $this->assertFalse($payload->isCreate());
        $this->assertFalse($payload->isUpdate());
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
