<?php
namespace spec\DevBoard\GithubEvent\Status;

use DevBoard\Github\Commit\CalculateState\CalculateGithubCommitState;
use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatus;
use DevBoard\Github\CommitStatus\GithubCommitStatusFacade;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use DevBoard\Github\ExternalService\GithubExternalServiceFacade;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubEvent\Status\Data\CommitFactory;
use DevBoard\GithubEvent\Status\Data\CommitStatusFactory;
use DevBoard\GithubEvent\Status\Data\ExternalServiceFactory;
use DevBoard\GithubEvent\Status\Data\RepoFactory;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\CommitStatus\CommitStatus;
use DevBoard\GithubRemote\ValueObject\ExternalService\ExternalService;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatusHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Status\StatusHandler');
    }

    public function let(
        RepoFactory $repoFactory,
        CommitFactory $commitFactory,
        ExternalServiceFactory $externalServiceFactory,
        CommitStatusFactory $commitStatusFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubExternalServiceFacade $githubExternalServiceFacade,
        GithubCommitStatusFacade $githubCommitStatusFacade,
        CalculateGithubCommitState $calculateGithubCommitState,
        EntityManager $em

    ) {
        $this->beConstructedWith(
            $repoFactory,
            $commitFactory,
            $externalServiceFactory,
            $commitStatusFactory,
            $githubRepoFacade,
            $githubCommitFacade,
            $githubExternalServiceFacade,
            $githubCommitStatusFacade,
            $calculateGithubCommitState,
            $em
        );
    }

    public function it_will_create(

        $repoFactory,
        $commitFactory,
        $externalServiceFactory,
        $commitStatusFactory,
        $githubRepoFacade,
        $githubCommitFacade,
        $githubExternalServiceFacade,
        $githubCommitStatusFacade,
        $calculateGithubCommitState,
        $em,
        StatusPayload $statusPayload,
        Repo $repoValueObject,
        Commit $commitValueObject,
        ExternalService $externalServiceValueObject,
        CommitStatus $commitStatusValueObject,
        GithubRepo $githubRepoEntity,
        GithubCommit $githubCommitEntity,
        GithubExternalService $githubExternalService,
        GithubCommitStatus $githubCommitStatus
    ) {
        $repoFactory->create($statusPayload)->willReturn($repoValueObject);
        $commitFactory->create($statusPayload)->willReturn($commitValueObject);
        $externalServiceFactory->create($statusPayload)->willReturn($externalServiceValueObject);
        $commitStatusFactory->create($statusPayload)->willReturn($commitStatusValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
        $githubCommitFacade->getOrCreate($githubRepoEntity, $commitValueObject)->willReturn($githubCommitEntity);
        $githubExternalServiceFacade->getOrCreate('external-service-context')->willReturn($githubExternalService);

        $externalServiceValueObject->getContext()->willReturn('external-service-context');

        $githubCommitStatusFacade
            ->getOrCreate($githubCommitEntity, $githubExternalService, $commitStatusValueObject)
            ->willReturn($githubCommitStatus);

        $githubCommitStatus->setState(GithubCommitStatusState::convert($commitStatusValueObject->getStatus()));
        $calculateGithubCommitState->calculate($githubCommitEntity)->shouldBeCalled();

        $em->persist($githubCommitStatus)->shouldBeCalled();
        $em->refresh($githubCommitEntity)->shouldBeCalled();
        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->process($statusPayload)->shouldReturn(true);
    }
}
