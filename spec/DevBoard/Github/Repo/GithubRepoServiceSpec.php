<?php
namespace spec\DevBoard\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\Mapper\RemoteToEntityMapper;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Repo\GithubRepoData;
use NullDev\GithubApi\Repo\RemoteGithubRepoService;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\GithubRepoService');
    }

    public function let(
        GithubRepoFactory $repoFactory,
        RemoteGithubRepoService $remoteService,
        RemoteToEntityMapper $mapper,
        EntityManager $em
    ) {
        $this->beConstructedWith($repoFactory, $remoteService, $mapper, $em);
    }

    public function it_will_create_github_repo(
        $repoFactory,
        $remoteService,
        $mapper,
        $em,
        User $user,
        GithubRepo $repo,
        GithubRepoData $githubRepoData
    ) {
        $repoFactory->create('owner/name')->willReturn($repo);
        $remoteService->fetch($repo, $user)->willReturn($githubRepoData);
        $mapper->map($githubRepoData, $repo)->shouldBeCalled();
        $em->persist($repo)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create('owner/name', $user)->shouldReturnAnInstanceOf('DevBoard\Github\Repo\Entity\GithubRepo');
    }

    public function it_will_catch_exception_since_repo_doesnt_exist(
        $repoFactory,
        $remoteService,
        User $user,
        GithubRepo $repo,
        GithubRepoData $githubRepoData
    ) {
        $repoFactory->create('owner/name')->willReturn($repo);
        $remoteService->fetch($repo, $user)->willThrow(new \Exception());

        $this->shouldThrow('Exception')
            ->duringCreate('owner/name', $user);
    }

    public function it_will_catch_exception_since_user_has_no_write_privileges_on_repo(
        $repoFactory,
        $remoteService,
        User $user,
        GithubRepo $repo,
        GithubRepoData $githubRepoData
    ) {
        $repoFactory->create('owner/name')->willReturn($repo);
        $remoteService->fetch($repo, $user)->willThrow(new \Exception());

        $this->shouldThrow('Exception')
            ->duringCreate('owner/name', $user);
    }
}
