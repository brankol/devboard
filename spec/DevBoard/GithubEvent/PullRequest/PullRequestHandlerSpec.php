<?php
namespace spec\DevBoard\GithubEvent\PullRequest;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\PullRequest\Entity\GithubPullRequest;
use DevBoard\Github\PullRequest\GithubPullRequestFacade;
use DevBoard\Github\PullRequest\GithubPullRequestState;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubEvent\PullRequest\Data\CommitFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestAssigneeFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestCreatorFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestFactory;
use DevBoard\GithubEvent\PullRequest\Data\RepoFactory;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\PullRequestHandler');
    }

    public function let(
        RepoFactory $repoFactory,
        PullRequestFactory $pullRequestFactory,
        CommitFactory $commitFactory,
        PullRequestCreatorFactory $pullRequestCreatorFactory,
        PullRequestAssigneeFactory $pullRequestAssigneeFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubPullRequestFacade $githubPullRequestFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em

    ) {
        $this->beConstructedWith(
            $repoFactory,
            $pullRequestFactory,
            $commitFactory,
            $pullRequestCreatorFactory,
            $pullRequestAssigneeFactory,
            $githubRepoFacade,
            $githubPullRequestFacade,
            $githubCommitFacade,
            $githubUserFacade,
            $em
        );
    }

    public function it_will_create(

        $repoFactory,
        $pullRequestFactory,
        $commitFactory,
        $pullRequestCreatorFactory,
        $pullRequestAssigneeFactory,
        $githubRepoFacade,
        $githubPullRequestFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        PullRequestPayload $pullRequestPayload,
        Repo $repoValueObject,
        PullRequest $pullRequestValueObject,
        Commit $commitValueObject,
        CommitAuthor $pullRequestCreatorValueObject,
        CommitCommitter $pullRequestAssigneeValueObject,
        GithubRepo $githubRepoEntity,
        GithubPullRequest $githubPullRequestEntity,
        GithubCommit $githubCommitEntity,
        GithubUser $githubPullRequestCreatorEntity,
        GithubUser $githubPullRequestAssigneeEntity
    ) {
        $pullRequestPayload->getPullRequestAssigneeDetails()->willReturn(['assignee-details']);

        $repoFactory->create($pullRequestPayload)->willReturn($repoValueObject);
        $pullRequestFactory->create($pullRequestPayload)->willReturn($pullRequestValueObject);
        $commitFactory->create($pullRequestPayload)->willReturn($commitValueObject);
        $pullRequestCreatorFactory->create($pullRequestPayload)->willReturn($pullRequestCreatorValueObject);
        $pullRequestAssigneeFactory->create($pullRequestPayload)->willReturn($pullRequestAssigneeValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
        $githubPullRequestFacade->getOrCreate($githubRepoEntity, $pullRequestValueObject)
            ->willReturn($githubPullRequestEntity);
        $githubCommitFacade->getOrCreate($githubRepoEntity, $commitValueObject)->willReturn($githubCommitEntity);
        $githubUserFacade->getOrCreate($pullRequestCreatorValueObject)->willReturn($githubPullRequestCreatorEntity);
        $githubUserFacade->getOrCreate($pullRequestAssigneeValueObject)->willReturn($githubPullRequestAssigneeEntity);

        $githubPullRequestEntity->setCreatedBy($githubPullRequestCreatorEntity)->shouldBeCalled();
        $githubPullRequestEntity->setAssignedTo($githubPullRequestAssigneeEntity)->shouldBeCalled();

        $githubPullRequestEntity->setLastCommit($githubCommitEntity)->shouldBeCalled();
        $githubPullRequestEntity->setState(GithubPullRequestState::OPENED)->shouldBeCalled();

        $pullRequestValueObject->getState()->willReturn('opened');
        $em->persist($githubPullRequestEntity)->shouldBeCalled();
        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->process($pullRequestPayload)->shouldReturn(true);
    }
}
