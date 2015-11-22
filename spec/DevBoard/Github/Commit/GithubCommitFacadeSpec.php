<?php
namespace spec\DevBoard\Github\Commit;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\Entity\GithubCommitFactory;
use DevBoard\Github\Commit\Entity\GithubCommitRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\GithubCommitFacade');
    }

    public function let(GithubCommitRepository $repository, GithubCommitFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubRepo $githubRepo,
        Commit $commitValueObject,
        GithubCommit $githubCommitEntity
    ) {
        $commitValueObject->getSha()->willReturn('sha');
        $repository->findOneBySha($githubRepo, 'sha')->willReturn($githubCommitEntity);
        $this->get($githubRepo, $commitValueObject)->shouldReturn($githubCommitEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        GithubRepo $githubRepo,
        Commit $commitValueObject
    ) {
        $commitValueObject->getSha()->willReturn('sha');
        $repository->findOneBySha($githubRepo, 'sha')->willReturn(null);
        $this->get($githubRepo, $commitValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubRepo $githubRepo,
        Commit $commitValueObject,
        GithubCommit $githubCommitEntity
    ) {
        $factory->createFromValueObject($githubRepo, $commitValueObject)->willReturn($githubCommitEntity);

        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($githubRepo, $commitValueObject)->shouldReturn($githubCommitEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubRepo $githubRepo,
        Commit $commitValueObject,
        GithubCommit $githubCommitEntity
    ) {
        $commitValueObject->getSha()->willReturn('sha');
        $repository->findOneBySha($githubRepo, 'sha')->willReturn($githubCommitEntity);
        $this->getOrCreate($githubRepo, $commitValueObject)->shouldReturn($githubCommitEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubRepo $githubRepo,
        Commit $commitValueObject,
        GithubCommit $githubCommitEntity
    ) {
        $commitValueObject->getSha()->willReturn('sha');
        $repository->findOneBySha($githubRepo, 'sha')->willReturn(null);

        $factory->createFromValueObject($githubRepo, $commitValueObject)->willReturn($githubCommitEntity);

        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($githubRepo, $commitValueObject)->shouldReturn($githubCommitEntity);
    }
}
