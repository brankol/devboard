<?php
namespace DevBoard\Github\Sync\Branches;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\Fetch\Branch\BranchHandler;
use NullDev\GithubApi\Branch\RemoteGithubBranchService;
use NullDev\UserBundle\Service\CurrentUserService;

/**
 * Class SyncBranchesHandler.
 */
class SyncBranchesHandler
{
    private $currentUserService;
    private $remoteGithubBranchService;
    private $branchHandler;

    /**
     * SyncBranchesHandler constructor.
     *
     * @param CurrentUserService        $currentUserService
     * @param RemoteGithubBranchService $remoteGithubBranchService
     * @param BranchHandler             $branchHandler
     */
    public function __construct(
        CurrentUserService $currentUserService,
        RemoteGithubBranchService $remoteGithubBranchService,
        BranchHandler $branchHandler
    ) {
        $this->currentUserService        = $currentUserService;
        $this->remoteGithubBranchService = $remoteGithubBranchService;
        $this->branchHandler             = $branchHandler;
    }

    /**
     * @param GithubRepo $githubRepo
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function sync(GithubRepo $githubRepo)
    {
        $branches = $this->remoteGithubBranchService->fetchAll($githubRepo, $this->currentUserService->getUser());

        foreach ($branches as $branchData) {
            $this->branchHandler->createOrUpdate($githubRepo, $branchData);
        }

        return true;
    }
}
