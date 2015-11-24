<?php
namespace DevBoard\Core\CreateProject;

use DevBoard\Core\Project\Entity\Project;
use DevBoard\Core\Project\Entity\ProjectFactory;
use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\Sync\Branches\SyncBranchesHandler;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Repo\RemoteGithubRepoService;
use NullDev\UserBundle\Service\CurrentUserService;

/**
 * Class CreateProjectHandler.
 */
class CreateProjectHandler
{
    private $currentUserService;
    private $githubRepoFactory;
    private $remoteGithubRepoService;
    private $githubRepoFacade;
    private $projectFactory;
    private $em;
    private $syncBranchesHandler;

    /**
     * CreateProjectHandler constructor.
     *
     * @param CurrentUserService      $currentUserService
     * @param GithubRepoFactory       $githubRepoFactory
     * @param RemoteGithubRepoService $remoteGithubRepoService
     * @param GithubRepoFacade        $githubRepoFacade
     * @param ProjectFactory          $projectFactory
     * @param EntityManager           $em
     * @param SyncBranchesHandler     $syncBranchesHandler
     */
    public function __construct(
        CurrentUserService $currentUserService,
        GithubRepoFactory $githubRepoFactory,
        RemoteGithubRepoService $remoteGithubRepoService,
        GithubRepoFacade $githubRepoFacade,
        ProjectFactory $projectFactory,
        EntityManager $em,
        SyncBranchesHandler $syncBranchesHandler
    ) {
        $this->currentUserService      = $currentUserService;
        $this->githubRepoFactory       = $githubRepoFactory;
        $this->remoteGithubRepoService = $remoteGithubRepoService;
        $this->githubRepoFacade        = $githubRepoFacade;
        $this->projectFactory          = $projectFactory;
        $this->em                      = $em;
        $this->syncBranchesHandler     = $syncBranchesHandler;
    }

    /**
     * @param $githubRepoFullName
     *
     * @throws \Exception
     *
     * @return Project
     */
    public function create($githubRepoFullName)
    {
        $repoEntity = $this->getRepoEntity($githubRepoFullName);

        $project = $this->projectFactory->create($githubRepoFullName);

        $project->addGithubRepo($repoEntity);
        $project->setUser($this->currentUserService->getUser());

        $this->em->persist($project);
        $this->em->flush();

        $this->syncBranchesHandler->sync($repoEntity);

        return $project;
    }

    /**
     * @param $githubRepoFullName
     *
     * @return \DevBoard\Github\Repo\Entity\GithubRepo|mixed
     */
    private function getRepoEntity($githubRepoFullName)
    {
        $remoteGithubRepoData = $this->getGithubRepoRemoteData($githubRepoFullName);

        return $this->githubRepoFacade->getOrCreate($remoteGithubRepoData);
    }

    /**
     * @param $githubRepoFullName
     *
     * @throws \Exception
     *
     * @return mixed
     */
    private function getGithubRepoRemoteData($githubRepoFullName)
    {
        return $this->remoteGithubRepoService->fetch(
            $this->githubRepoFactory->create($githubRepoFullName),
            $this->currentUserService->getUser()
        );
    }
}
