<?php
namespace spec\DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\Data\CommitFactory');
    }

    public function it_will_create_remote_commit_value_object(PullRequestPayload $pullRequestPayload)
    {
        $data = [
            'sha' => 'sha',
        ];

        $pullRequestPayload->getHeadCommitDetails()->willReturn($data);

        $result = $this->create($pullRequestPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Commit\Commit');
    }
}
