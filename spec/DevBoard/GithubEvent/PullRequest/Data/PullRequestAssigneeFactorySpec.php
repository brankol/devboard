<?php
namespace spec\DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestAssigneeFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\Data\PullRequestAssigneeFactory');
    }
    public function it_will_create_remote_commit_committer_value_object(PullRequestPayload $pullRequestPayload)
    {
        $this->create($pullRequestPayload)->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\PullRequestAssignee');

        $data = [
            'login'      => 'username',
            'id'         => 123,
            'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
        ];
        $pullRequestPayload->getPullRequestAssigneeDetails()->willReturn($data);

        $result = $this->create($pullRequestPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\PullRequestAssignee');
        $result->getName()->shouldReturn(null);
        $result->getEmail()->shouldReturn(null);
        $result->getGithubId()->shouldReturn(123);
        $result->getUsername()->shouldReturn('username');
        $result->getAvatarUrl()->shouldReturn('https://avatars.githubusercontent.com/u/123?v=3');
    }
}
