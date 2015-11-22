<?php
namespace DevBoard\Github\Commit\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\EntityRepository;

/**
 * Class GithubCommitRepository.
 */
class GithubCommitRepository extends EntityRepository
{
    /**
     * @param GithubRepo $githubRepo
     * @param string     $message
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function findOneByMessage(GithubRepo $githubRepo, $message)
    {
        return $this->findOneBy(
            [
                'message'    => $message,
                'githubRepo' => $githubRepo,
            ]
        );
    }

    /**
     * @param GithubRepo $githubRepo
     * @param string     $sha
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function findOneBySha(GithubRepo $githubRepo, $sha)
    {
        return $this->findOneBy(
            [
                'sha'        => $sha,
                'githubRepo' => $githubRepo,
            ]
        );
    }
}
