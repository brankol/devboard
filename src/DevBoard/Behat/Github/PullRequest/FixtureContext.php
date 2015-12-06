<?php
namespace DevBoard\Behat\Github\PullRequest;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\PullRequest\Entity\GithubPullRequest;
use Resources\Behat\DefaultContext;

/**
 * Class FixtureContext.
 */
class FixtureContext extends DefaultContext
{
    use DataTrait;
    use RepoDataTrait;

    /**
     * @Given there is :pullRequestName pullRequest on :githubRepoFullName github repo
     *
     * @param $pullRequestName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereIsPullRequestOnGithubRepo($pullRequestName, $githubRepoFullName)
    {
        $pullRequest = new GithubPullRequest();

        $pullRequest->setName($pullRequestName)
            ->setRepo($this->getGithubRepoByFullName($githubRepoFullName));

        $this->save($pullRequest);
    }
}
