<?php
namespace DevBoard\Github\Commit\Behat;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param $message
     *
     * @throws \Exception
     */
    private function getGithubCommitByMessage($message)
    {
        $commit = $this->getGithubCommitRepository()->findOneByMessage($message);

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
