<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch;

use DevBoard\Github\Branch\Entity\GithubBranch;
use DevBoard\Github\Branch\GithubBranchFacade;
use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubRemote\Fetch\Branch\Data\BranchFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitFactory;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Branch\GithubBranchData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\BranchHandler');
    }

    public function let(
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory,
        GithubBranchFacade $githubBranchFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em

    ) {
        $this->beConstructedWith(
            $branchFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory,
            $githubBranchFacade,
            $githubCommitFacade,
            $githubUserFacade,
            $em
        );
    }

    public function it_will_create_or_update_branch_data(

        $branchFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        $githubBranchFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        GithubBranchData $githubBranchData,
        Branch $branchValueObject,
        Commit $commitValueObject,
        CommitAuthor $commitAuthorValueObject,
        CommitCommitter $commitCommitterValueObject,
        GithubRepo $githubRepoEntity,
        GithubBranch $githubBranchEntity,
        GithubCommit $githubCommitEntity,
        GithubUser $authorEntity,
        GithubUser $committerEntity
    ) {
        $branchFactory->create($githubBranchData)->willReturn($branchValueObject);
        $commitFactory->create($githubBranchData)->willReturn($commitValueObject);
        $commitAuthorFactory->create($githubBranchData)->willReturn($commitAuthorValueObject);
        $commitCommitterFactory->create($githubBranchData)->willReturn($commitCommitterValueObject);

        $githubBranchFacade->getOrCreate($githubRepoEntity, $branchValueObject)->willReturn($githubBranchEntity);
        $githubCommitFacade->getOrCreate($githubRepoEntity, $commitValueObject)->willReturn($githubCommitEntity);
        $githubUserFacade->getOrCreate($commitAuthorValueObject)->willReturn($authorEntity);
        $githubUserFacade->getOrCreate($commitCommitterValueObject)->willReturn($committerEntity);

        $githubCommitEntity->setAuthor($authorEntity)->shouldBeCalled();
        $githubCommitEntity->setCommitter($committerEntity)->shouldBeCalled();

        $githubBranchEntity->setLastCommit($githubCommitEntity)->shouldBeCalled();

        $em->persist($githubBranchEntity)->shouldBeCalled();
        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->createOrUpdate($githubRepoEntity, $githubBranchData)->shouldReturn(true);
    }
}
