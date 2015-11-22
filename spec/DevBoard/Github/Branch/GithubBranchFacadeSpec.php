<?php
namespace spec\DevBoard\Github\Branch;

use DevBoard\Github\Branch\Entity\GithubBranch;
use DevBoard\Github\Branch\Entity\GithubBranchFactory;
use DevBoard\Github\Branch\Entity\GithubBranchRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubBranchFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Branch\GithubBranchFacade');
    }

    public function let(GithubBranchRepository $repository, GithubBranchFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubRepo $githubRepo,
        Branch $branchValueObject,
        GithubBranch $githubBranchEntity
    ) {
        $branchValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn($githubBranchEntity);
        $this->get($githubRepo, $branchValueObject)->shouldReturn($githubBranchEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        GithubRepo $githubRepo,
        Branch $branchValueObject
    ) {
        $branchValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn(null);
        $this->get($githubRepo, $branchValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubRepo $githubRepo,
        Branch $branchValueObject,
        GithubBranch $githubBranchEntity
    ) {
        $factory->createFromValueObject($githubRepo, $branchValueObject)->willReturn($githubBranchEntity);

        $em->persist($githubBranchEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($githubRepo, $branchValueObject)->shouldReturn($githubBranchEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubRepo $githubRepo,
        Branch $branchValueObject,
        GithubBranch $githubBranchEntity
    ) {
        $branchValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn($githubBranchEntity);
        $this->getOrCreate($githubRepo, $branchValueObject)->shouldReturn($githubBranchEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubRepo $githubRepo,
        Branch $branchValueObject,
        GithubBranch $githubBranchEntity
    ) {
        $branchValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn(null);

        $factory->createFromValueObject($githubRepo, $branchValueObject)->willReturn($githubBranchEntity);

        $em->persist($githubBranchEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($githubRepo, $branchValueObject)->shouldReturn($githubBranchEntity);
    }
}
