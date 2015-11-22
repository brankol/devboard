<?php
namespace DevBoard\Behat\Github\Commit;

use DevBoard\Github\Repo\Entity\GithubRepo;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param GithubRepo $githubRepo
     * @param            $sha
     *
     * @throws \Exception
     *
     * @return
     */
    private function getGithubCommitBySha(GithubRepo $githubRepo, $sha)
    {
        $commit = $this->getGithubCommitRepository()->findOneBySha($githubRepo, $sha);

        if (!$commit) {
            throw new \Exception('Cant find github commit with sha:'.$sha);
        }

        return $commit;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param            $message
     *
     * @throws \Exception
     *
     * @return
     */
    private function getGithubCommitByMessage(GithubRepo $githubRepo, $message)
    {
        $commit = $this->getGithubCommitRepository()->findOneByMessage($githubRepo, $message);

        if (!$commit) {
            throw new \Exception('Cant find github commit with message:'.$message);
        }

        return $commit;
    }

    /**
     * @return mixed
     */
    private function getGithubCommitRepository()
    {
        return $this->getEntityManager()->getRepository('GhCommit:GithubCommit');
    }
}
