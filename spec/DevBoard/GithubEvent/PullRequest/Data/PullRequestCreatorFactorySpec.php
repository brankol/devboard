<?php
namespace spec\DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestCreatorFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\Data\PullRequestCreatorFactory');
    }

    public function it_will_create_remote_commit_author_value_object(PullRequestPayload $pullRequestPayload)
    {
        $data = [
            'login'      => 'username',
            'id'         => 123,
            'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
        ];

        $pullRequestPayload->getPullRequestCreatorDetails()->willReturn($data);

        $result = $this->create($pullRequestPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\PullRequestCreator');
        $result->getName()->shouldReturn(null);
        $result->getEmail()->shouldReturn(null);
        $result->getGithubId()->shouldReturn(123);
        $result->getUsername()->shouldReturn('username');
        $result->getAvatarUrl()->shouldReturn('https://avatars.githubusercontent.com/u/123?v=3');
    }
}
