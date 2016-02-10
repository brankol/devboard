<?php
namespace tests\DevBoard\GithubEvent\Payload;

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

        self::assertTrue($payload->isBranch());
        self::assertTrue($payload->isCreate());
        self::assertSame(PushPayload::CREATED, $payload->getType());

        self::assertFalse($payload->isTag());
        self::assertFalse($payload->isUpdate());
        self::assertFalse($payload->isDelete());
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

        self::assertTrue($payload->isBranch());
        self::assertTrue($payload->isUpdate());
        self::assertSame(PushPayload::UPDATED, $payload->getType());

        self::assertFalse($payload->isTag());
        self::assertFalse($payload->isCreate());
        self::assertFalse($payload->isDelete());
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

        self::assertTrue($payload->isBranch());
        self::assertTrue($payload->isDelete());
        self::assertSame(PushPayload::DELETED, $payload->getType());

        self::assertFalse($payload->isTag());
        self::assertFalse($payload->isCreate());
        self::assertFalse($payload->isUpdate());
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
