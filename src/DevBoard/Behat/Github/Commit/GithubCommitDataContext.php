<?php
namespace DevBoard\Behat\Github\Commit;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use Resources\Behat\DefaultContext;

/**
 * Class GithubCommitDataContext.
 */
class GithubCommitDataContext extends DefaultContext
{
    use DataTrait;
    use RepoDataTrait;

    /**
     * @Then there should be github commit :sha for :githubRepoFullName in system
     *
     * @param $sha
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubCommitForInSystem($sha, $githubRepoFullName)
    {
        $this->getGithubCommitBySha($this->getGithubRepoByFullName($githubRepoFullName), $sha);
    }

    /**
     * @Then there should be no github commit :sha for :githubRepoFullName in system
     *
     * @param $sha
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeNoGithubCommitForInSystem($sha, $githubRepoFullName)
    {
        $commit = $this->getGithubCommitRepository()->findOneBySha(
            $this->getGithubRepoByFullName($githubRepoFullName),
            $sha
        );

        if ($commit) {
            throw new \Exception('We found github commit with sha:'.$sha);
        }
    }

    /**
     * @Then there should be github commit with message :message on :githubRepoFullName repo in system
     *
     * @param $message
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubCommitWithMessageInSystem($message, $githubRepoFullName)
    {
        $this->getGithubCommitByMessage($this->getGithubRepoByFullName($githubRepoFullName), $message);
    }
}
