<?php
namespace spec\DevBoard\Github\CommitStatus;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatus;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatusFactory;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatusRepository;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitStatusFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\CommitStatus\GithubCommitStatusFacade');
    }

    public function let(GithubCommitStatusRepository $repository, GithubCommitStatusFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubCommit $githubCommit,
        GithubExternalService $githubExternalService,
        GithubCommitStatus $githubCommitStatus
    ) {
        $repository
            ->findOneByRepoCommitAndExternalService($githubCommit, $githubExternalService)
            ->willReturn($githubCommitStatus);
        $this->get($githubCommit, $githubExternalService)->shouldReturn($githubCommitStatus);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubCommit $githubCommit,
        GithubExternalService $githubExternalService,
        GithubCommitStatus $githubCommitStatus
    ) {
        $factory->create($githubCommit, $githubExternalService)->willReturn($githubCommitStatus);

        $em->persist($githubCommitStatus)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($githubCommit, $githubExternalService)->shouldReturn($githubCommitStatus);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubCommit $githubCommit,
        GithubExternalService $githubExternalService,
        GithubCommitStatus $githubCommitStatus
    ) {
        $repository
            ->findOneByRepoCommitAndExternalService($githubCommit, $githubExternalService)
            ->willReturn($githubCommitStatus);
        $this->getOrCreate($githubCommit, $githubExternalService)->shouldReturn($githubCommitStatus);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubCommit $githubCommit,
        GithubExternalService $githubExternalService,
        GithubCommitStatus $githubCommitStatus
    ) {
        $repository
            ->findOneByRepoCommitAndExternalService($githubCommit, $githubExternalService)
            ->willReturn(null);

        $factory->create($githubCommit, $githubExternalService)->willReturn($githubCommitStatus);

        $em->persist($githubCommitStatus)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($githubCommit, $githubExternalService)->shouldReturn($githubCommitStatus);
    }
}
