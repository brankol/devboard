<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchPayloadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\BranchPayload');
    }

    public function let(
        GithubRepo $repo,
        Branch $branch,
        Commit $lastCommit,
        CommitAuthor $lastCommitAuthor,
        CommitCommitter $lastCommitCommitter
    ) {
        $this->beConstructedWith($repo, $branch, $lastCommit, $lastCommitAuthor, $lastCommitCommitter);
    }
}
