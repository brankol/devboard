<?php
namespace DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use DevBoard\Github\Repo\Entity\GithubRepo;

/**
 * Class GithubCommitStatusFactory.
 */
class GithubCommitStatusFactory
{
    public function create(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        $status = new GithubCommitStatus();
        $status->setGithubCommit($githubCommit)
            ->setGithubExternalService($githubExternalService);

        return $status;
    }
}
