<?php
namespace spec\DevBoard\GithubEvent\Push\Branch;

use DevBoard\Github\Branch\Entity\GithubBranch;
use DevBoard\Github\Branch\GithubBranchFacade;
use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\GithubUserFacade;
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
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Branch\BranchHandler');
    }

    public function let(
        RepoFactory $repoFactory,
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubBranchFacade $githubBranchFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em

    ) {
        $this->beConstructedWith(
            $repoFactory,
            $branchFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory,
            $githubRepoFacade,
            $githubBranchFacade,
            $githubCommitFacade,
            $githubUserFacade,
            $em
        );
    }

    public function it_will_create(

        $repoFactory,
        $branchFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        $githubRepoFacade,
        $githubBranchFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
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
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $branchFactory->create($pushPayload)->willReturn($branchValueObject);
        $commitFactory->create($pushPayload)->willReturn($commitValueObject);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthorValueObject);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitterValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
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

        $this->create($pushPayload)->shouldReturn(true);
    }

    public function it_will_update(
        $repoFactory,
        $branchFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        $githubRepoFacade,
        $githubBranchFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
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
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $branchFactory->create($pushPayload)->willReturn($branchValueObject);
        $commitFactory->create($pushPayload)->willReturn($commitValueObject);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthorValueObject);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitterValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
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

        $this->update($pushPayload)->shouldReturn(true);
    }

    public function it_will_delete(
        $repoFactory,
        $branchFactory,
        $githubRepoFacade,
        $githubBranchFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
        Branch $branchValueObject,
        GithubRepo $githubRepoEntity,
        GithubBranch $githubBranchEntity
    ) {
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $branchFactory->create($pushPayload)->willReturn($branchValueObject);

        $githubRepoFacade->get($repoValueObject)->willReturn($githubRepoEntity);
        $githubBranchFacade->get($githubRepoEntity, $branchValueObject)->willReturn($githubBranchEntity);

        $em->remove($githubBranchEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->delete($pushPayload)->shouldReturn(true);
    }
}
