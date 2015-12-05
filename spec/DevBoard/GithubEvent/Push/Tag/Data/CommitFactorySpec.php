<?php
namespace spec\DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\Data\CommitFactory');
    }

    public function it_will_create_remote_commit_value_object(PushPayload $pushPayload)
    {
        $data = [
            'id'        => 'sha',
            'message'   => 'Message',
            'timestamp' => '2015-11-20T22:25:30+01:00',
        ];

        $pushPayload->getHeadCommitDetails()->willReturn($data);

        $result = $this->create($pushPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Commit\Commit');

        $result->getSha()->shouldReturn('sha');
        $result->getMessage()->shouldReturn('Message');
    }
}
