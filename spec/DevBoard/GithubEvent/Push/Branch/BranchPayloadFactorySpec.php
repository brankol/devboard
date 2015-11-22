<?php
namespace spec\DevBoard\GithubEvent\Push\Branch;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Branch\Data\BranchFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Branch\Data\RepoFactory;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchPayloadFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Branch\BranchPayloadFactory');
    }

    public function let(
        RepoFactory $repoFactory,
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->beConstructedWith(
            $repoFactory,
            $branchFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory
        );
    }

    public function it_will_create_branch_payload_from_push_payload(
        $repoFactory,
        $branchFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        PushPayload $pushPayload,
        Repo $repo,
        Branch $branch,
        Commit $commit,
        CommitAuthor $commitAuthor,
        CommitCommitter $commitCommitter
    ) {
        $repoFactory->create($pushPayload)->willReturn($repo);
        $branchFactory->create($pushPayload)->willReturn($branch);
        $commitFactory->create($pushPayload)->willReturn($commit);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthor);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitter);

        $this->create($pushPayload)->shouldReturnAnInstanceOf('DevBoard\GithubEvent\Push\Branch\BranchPayload');
    }
}
