<?php
namespace spec\DevBoard\GithubEvent\Status\Data;

use DevBoard\GithubEvent\Payload\StatusPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Status\Data\CommitFactory');
    }

    public function it_will_create_remote_commit_value_object(StatusPayload $statusPayload)
    {
        $data = [
            'sha'    => 'sha',
            'commit' => [
                'author' => [
                    'date' => '2015-11-30T20:47:39Z',
                ],
                'committer' => [
                    'date' => '2015-11-30T20:47:39Z',
                ],
                'message' => 'Message',
            ],
        ];

        $statusPayload->getCommitDetails()->willReturn($data);

        $result = $this->create($statusPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Commit\Commit');

        $result->getSha()->shouldReturn('sha');
        $result->getMessage()->shouldReturn('Message');
    }
}
