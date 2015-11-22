<?php
namespace spec\DevBoard\Github\User;

use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\Entity\GithubUserFactory;
use DevBoard\Github\User\Entity\GithubUserRepository;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\User\GithubUserDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\GithubUserFacade');
    }

    public function let(GithubUserRepository $repository, GithubUserFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubUserDataInterface $userValueObject,
        GithubUser $githubUserEntity
    ) {
        $userValueObject->getUsername()->willReturn('username');
        $repository->findOneByUsername('username')->willReturn($githubUserEntity);
        $this->get($userValueObject)->shouldReturn($githubUserEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        GithubUserDataInterface $userValueObject
    ) {
        $userValueObject->getUsername()->willReturn('username');
        $repository->findOneByUsername('username')->willReturn(null);
        $this->get($userValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubUserDataInterface $userValueObject,
        GithubUser $githubUserEntity
    ) {
        $factory->createFromValueObject($userValueObject)->willReturn($githubUserEntity);

        $em->persist($githubUserEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($userValueObject)->shouldReturn($githubUserEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubUserDataInterface $userValueObject,
        GithubUser $githubUserEntity
    ) {
        $userValueObject->getUsername()->willReturn('username');
        $repository->findOneByUsername('username')->willReturn($githubUserEntity);
        $this->getOrCreate($userValueObject)->shouldReturn($githubUserEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubUserDataInterface $userValueObject,
        GithubUser $githubUserEntity
    ) {
        $userValueObject->getUsername()->willReturn('username');
        $repository->findOneByUsername('username')->willReturn(null);

        $factory->createFromValueObject($userValueObject)->willReturn($githubUserEntity);

        $em->persist($githubUserEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($userValueObject)->shouldReturn($githubUserEntity);
    }
}
