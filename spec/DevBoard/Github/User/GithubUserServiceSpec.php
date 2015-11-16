<?php
namespace spec\DevBoard\Github\User;

use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\Entity\GithubUserFactory;
use DevBoard\Github\User\Mapper\RemoteToEntityMapper;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\User\GithubUserData;
use NullDev\GithubApi\User\RemoteGithubUserService;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\GithubUserService');
    }

    public function let(
        GithubUserFactory $userFactory,
        RemoteGithubUserService $remoteService,
        RemoteToEntityMapper $mapper,
        EntityManager $em
    ) {
        $this->beConstructedWith($userFactory, $remoteService, $mapper, $em);
    }

    public function it_will_create_github_user(
        $userFactory,
        $remoteService,
        $mapper,
        $em,
        User $user,
        GithubUser $githubUser,
        GithubUserData $githubUserData
    ) {
        $userFactory->create('username')->willReturn($githubUser);
        $remoteService->fetch($githubUser, $user)->willReturn($githubUserData);
        $mapper->map($githubUserData, $githubUser)->shouldBeCalled();
        $em->persist($githubUser)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create('username', $user)->shouldReturnAnInstanceOf('DevBoard\Github\User\Entity\GithubUser');
    }

    public function it_will_catch_exception_since_user_doesnt_exist(
        $userFactory,
        $remoteService,
        User $user,
        GithubUser $githubUser,
        GithubUserData $githubUserData
    ) {
        $userFactory->create('username')->willReturn($githubUser);
        $remoteService->fetch($githubUser, $user)->willThrow(new \Exception());

        $this->shouldThrow('Exception')
            ->duringCreate('username', $user);
    }
}
