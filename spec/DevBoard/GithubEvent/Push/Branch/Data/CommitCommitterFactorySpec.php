<?php
namespace spec\DevBoard\GithubEvent\Push\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitCommitterFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Branch\Data\CommitCommitterFactory');
    }
    public function it_will_create_remote_commit_committer_value_object(PushPayload $pushPayload)
    {
        $this->create($pushPayload)->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\CommitCommitter');

        $data = ['name' => 'name', 'email' => 'email@example.com', 'username' => 'username'];
        $pushPayload->getCommitCommiterDetails()->willReturn($data);

        $result = $this->create($pushPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\CommitCommitter');
        $result->getName()->shouldReturn('name');
        $result->getEmail()->shouldReturn('email@example.com');
        $result->getUsername()->shouldReturn('username');
    }
}
