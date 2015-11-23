<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\Fetch\Branch\Data\BranchFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitFactory;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use NullDev\GithubApi\Branch\GithubBranchData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchPayloadFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\BranchPayloadFactory');
    }

    public function let(
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->beConstructedWith(
            $branchFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory
        );
    }

    public function it_will_create_branch_payload_from_received_payload(
        $branchFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        GithubBranchData $githubBranchData,
        GithubRepo $repo,
        Branch $branch,
        Commit $commit,
        CommitAuthor $commitAuthor,
        CommitCommitter $commitCommitter
    ) {
        $branchFactory->create($githubBranchData)->willReturn($branch);
        $commitFactory->create($githubBranchData)->willReturn($commit);
        $commitAuthorFactory->create($githubBranchData)->willReturn($commitAuthor);
        $commitCommitterFactory->create($githubBranchData)->willReturn($commitCommitter);

        $this->create($repo, $githubBranchData)
            ->shouldReturnAnInstanceOf('DevBoard\GithubRemote\Fetch\Branch\BranchPayload');
    }
}
