<?php
namespace spec\DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitAuthorFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\Data\CommitAuthorFactory');
    }

    public function it_will_create_remote_commit_author_value_object(PushPayload $pushPayload)
    {
        $data = ['name' => 'name', 'email' => 'email@example.com', 'username' => 'username'];
        $pushPayload->getCommitAuthorDetails()->willReturn($data);

        $result = $this->create($pushPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\CommitAuthor');
        $result->getName()->shouldReturn('name');
        $result->getEmail()->shouldReturn('email@example.com');
        $result->getUsername()->shouldReturn('username');
    }
}
