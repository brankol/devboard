<?php
namespace DevBoard\Behat\Github\PullRequest;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use Resources\Behat\DefaultContext;

/**
 * Class GithubPullRequestDataContext.
 */
class GithubPullRequestDataContext extends DefaultContext
{
    use DataTrait;
    use RepoDataTrait;

    /**
     * @Then there should be github pullRequest :pullRequestName for :githubRepoFullName in system
     *
     * @param $pullRequestName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubPullRequestForInSystem($pullRequestName, $githubRepoFullName)
    {
        $pullRequest = $this->getGithubPullRequestRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $pullRequestName
            );

        if (!$pullRequest) {
            throw new \Exception('Cant find github pullRequest with name:'.$pullRequestName.' for repo '.$githubRepoFullName);
        }
    }

    /**
     * @Then there should be no github pullRequest :pullRequestName for :githubRepoFullName in system
     *
     * @param $pullRequestName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeNoGithubPullRequestForInSystem($pullRequestName, $githubRepoFullName)
    {
        $pullRequest = $this->getGithubPullRequestRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $pullRequestName
            );

        if ($pullRequest) {
            throw new \Exception('We found github pullRequest with name:'.$pullRequestName.' for repo '.$githubRepoFullName);
        }
    }
}
