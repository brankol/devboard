<?php
namespace spec\DevBoard\GithubEvent\PullRequest;

use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestPayloadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\PullRequestPayload');
    }

    public function let(
        Repo $repo,
        PullRequest $pullRequest,
        Commit $lastCommit,
        CommitAuthor $lastCommitAuthor,
        CommitCommitter $lastCommitCommitter
    ) {
        $this->beConstructedWith($repo, $pullRequest, $lastCommit, $lastCommitAuthor, $lastCommitCommitter);
    }
}
