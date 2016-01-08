<?php
namespace spec\DevBoard\Core\CreateProject;

use DevBoard\Core\Project\Entity\Project;
use DevBoard\Core\Project\Entity\ProjectFactory;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\Sync\Branches\SyncBranchesHandler;
use DevBoard\GithubApi\Repository\Hook\HookClient;
use DevBoard\GithubApi\Repository\Hook\HookClientFactory;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Repo\GithubRepoData;
use NullDev\GithubApi\Repo\RemoteGithubRepoService;
use NullDev\UserBundle\Entity\User;
use NullDev\UserBundle\Service\CurrentUserService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateProjectHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\CreateProjectHandler');
    }

    public function let(
        CurrentUserService $currentUserService,
        GithubRepoFactory $githubRepoFactory,
        RemoteGithubRepoService $remoteGithubRepoService,
        GithubRepoFacade $githubRepoFacade,
        ProjectFactory $projectFactory,
        EntityManager $em,
        SyncBranchesHandler $syncBranchesHandler,
        HookClientFactory $hookClientFactory
    ) {
        $this->beConstructedWith(
            $currentUserService,
            $githubRepoFactory,
            $remoteGithubRepoService,
            $githubRepoFacade,
            $projectFactory,
            $em,
            $syncBranchesHandler,
            $hookClientFactory
        );
    }

    public function it_will_create_new_project(
        $currentUserService,
        $githubRepoFactory,
        $remoteGithubRepoService,
        $githubRepoFacade,
        $projectFactory,
        $em,
        $syncBranchesHandler,
        $hookClientFactory,
        GithubRepo $githubRepoInitial,
        GithubRepo $githubRepoEntity,
        Project $project,
        GithubRepoData $githubRepoData,
        User $user,
        HookClient $hookClient

    ) {
        $githubRepoFactory->create('owner/name')->willReturn($githubRepoInitial);

        $currentUserService->getUser()->willReturn($user);

        $remoteGithubRepoService->fetch($githubRepoInitial, $user)->willReturn($githubRepoData);

        $githubRepoFacade->getOrCreate($githubRepoData)->willReturn($githubRepoEntity);

        $projectFactory->create('owner/name')->willReturn($project);

        $project->addGithubRepo($githubRepoEntity)->shouldBeCalled();
        $project->setUser($user)->shouldBeCalled();

        $em->persist($project)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $syncBranchesHandler->sync($githubRepoEntity)->willReturn(true);
        $hookClientFactory->create($githubRepoEntity, $user)->willReturn($hookClient);
        $hookClient->createHook()->shouldBeCalled();

        $this->create('owner/name')->shouldReturn($project);
    }
}
