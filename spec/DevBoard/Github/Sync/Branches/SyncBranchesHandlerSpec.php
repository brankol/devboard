<?php
namespace spec\DevBoard\Github\Sync\Branches;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\Fetch\Branch\BranchHandler;
use NullDev\GithubApi\Branch\GithubBranchData;
use NullDev\GithubApi\Branch\RemoteGithubBranchService;
use NullDev\UserBundle\Entity\User;
use NullDev\UserBundle\Service\CurrentUserService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SyncBranchesHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Sync\Branches\SyncBranchesHandler');
    }

    public function let(
        CurrentUserService $currentUserService,
        RemoteGithubBranchService $remoteGithubBranchService,
        BranchHandler $branchHandler
    ) {
        $this->beConstructedWith(
            $currentUserService,
            $remoteGithubBranchService,
            $branchHandler
        );
    }

    public function it_will_sync_all_repo_branches(
        $currentUserService,
        $remoteGithubBranchService,
        $branchHandler,
        GithubRepo $githubRepo,
        User $user,
        GithubBranchData $githubBranchData
    ) {
        $currentUserService->getUser()->willReturn($user);

        $remoteGithubBranchService->fetchAll($githubRepo, $user)->willReturn([$githubBranchData]);

        $branchHandler->createOrUpdate($githubRepo, $githubBranchData)->willReturn(true);

        $this->sync($githubRepo)->shouldReturn(true);
    }
}
