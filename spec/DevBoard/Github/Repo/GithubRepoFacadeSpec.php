<?php
namespace spec\DevBoard\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\Entity\GithubRepoRepository;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\GithubRepoFacade');
    }

    public function let(GithubRepoRepository $repository, GithubRepoFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity($repository, Repo $repoValueObject, GithubRepo $githubRepoEntity)
    {
        $repoValueObject->getFullName()->willReturn('owner/repo');
        $repository->findOneByFullName('owner/repo')->willReturn($githubRepoEntity);
        $this->get($repoValueObject)->shouldReturn($githubRepoEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        Repo $repoValueObject
    ) {
        $repoValueObject->getFullName()->willReturn('owner/repo');
        $repository->findOneByFullName('owner/repo')->willReturn(null);
        $this->get($repoValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity($factory, $em, Repo $repoValueObject, GithubRepo $githubRepoEntity)
    {
        $factory->createFromValueObject($repoValueObject)->willReturn($githubRepoEntity);

        $em->persist($githubRepoEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($repoValueObject)->shouldReturn($githubRepoEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        Repo $repoValueObject,
        GithubRepo $githubRepoEntity
    ) {
        $repoValueObject->getFullName()->willReturn('owner/repo');
        $repository->findOneByFullName('owner/repo')->willReturn($githubRepoEntity);
        $this->getOrCreate($repoValueObject)->shouldReturn($githubRepoEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        Repo $repoValueObject,
        GithubRepo $githubRepoEntity
    ) {
        $repoValueObject->getFullName()->willReturn('owner/repo');
        $repository->findOneByFullName('owner/repo')->willReturn(null);

        $factory->createFromValueObject($repoValueObject)->willReturn($githubRepoEntity);

        $em->persist($githubRepoEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($repoValueObject)->shouldReturn($githubRepoEntity);
    }
}
