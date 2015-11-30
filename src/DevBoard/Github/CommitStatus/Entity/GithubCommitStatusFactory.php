<?php
namespace DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;

/**
 * Class GithubCommitStatusFactory.
 */
class GithubCommitStatusFactory
{
    /**
     * @param GithubCommit          $githubCommit
     * @param GithubExternalService $githubExternalService
     *
     * @return GithubCommitStatus
     */
    public function create(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        $status = new GithubCommitStatus();
        $status->setGithubCommit($githubCommit)
            ->setGithubExternalService($githubExternalService);

        return $status;
    }
}
