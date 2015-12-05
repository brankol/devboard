<?php
namespace spec\DevBoard\Github\Tag;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Tag\Entity\GithubTag;
use DevBoard\Github\Tag\Entity\GithubTagFactory;
use DevBoard\Github\Tag\Entity\GithubTagRepository;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubTagFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Tag\GithubTagFacade');
    }

    public function let(GithubTagRepository $repository, GithubTagFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubRepo $githubRepo,
        Tag $tagValueObject,
        GithubTag $githubTagEntity
    ) {
        $tagValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn($githubTagEntity);
        $this->get($githubRepo, $tagValueObject)->shouldReturn($githubTagEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        GithubRepo $githubRepo,
        Tag $tagValueObject
    ) {
        $tagValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn(null);
        $this->get($githubRepo, $tagValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubRepo $githubRepo,
        Tag $tagValueObject,
        GithubTag $githubTagEntity
    ) {
        $factory->createFromValueObject($githubRepo, $tagValueObject)->willReturn($githubTagEntity);

        $em->persist($githubTagEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($githubRepo, $tagValueObject)->shouldReturn($githubTagEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubRepo $githubRepo,
        Tag $tagValueObject,
        GithubTag $githubTagEntity
    ) {
        $tagValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn($githubTagEntity);
        $this->getOrCreate($githubRepo, $tagValueObject)->shouldReturn($githubTagEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubRepo $githubRepo,
        Tag $tagValueObject,
        GithubTag $githubTagEntity
    ) {
        $tagValueObject->getName()->willReturn('master');
        $repository->findOneByName($githubRepo, 'master')->willReturn(null);

        $factory->createFromValueObject($githubRepo, $tagValueObject)->willReturn($githubTagEntity);

        $em->persist($githubTagEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($githubRepo, $tagValueObject)->shouldReturn($githubTagEntity);
    }
}
