<?php
namespace DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\EntityRepository;

/**
 * Class GithubCommitStatusRepository.
 */
class GithubCommitStatusRepository extends EntityRepository
{
    /**
     * @param GithubCommit          $githubCommit
     * @param GithubExternalService $githubExternalService
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    public function findOneByRepoCommitAndExternalService(
        GithubCommit $githubCommit,
        GithubExternalService $githubExternalService
    ) {
        return $this->findOneBy(
            [
                'githubCommit'          => $githubCommit,
                'githubExternalService' => $githubExternalService,
            ]
        );
    }
}
