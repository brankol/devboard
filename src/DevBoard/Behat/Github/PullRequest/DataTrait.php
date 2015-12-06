<?php
namespace DevBoard\Behat\Github\PullRequest;

use DevBoard\Github\PullRequest\Entity\GithubPullRequest;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param $repo
     * @param $name
     *
     * @throws \Exception
     *
     * @return
     */
    private function getGithubPullRequestByName($repo, $name)
    {
        $pullRequest = $this->getGithubPullRequestRepository()
            ->findOneByName(
                $repo,
                $name
            );

        if (!$pullRequest) {
            throw new \Exception('Cant find github pullRequest with name:'.$name);
        }

        return $pullRequest;
    }

    /**
     * @return mixed
     */
    private function getGithubPullRequestRepository()
    {
        return $this->getEntityManager()->getRepository('GhPullRequest:GithubPullRequest');
    }

    /**
     * @param $name
     *
     * @return GithubPullRequest
     */
    private function createPullRequestObjectFromPullRequestName($name)
    {
        $pullRequest = new GithubPullRequest();
        $pullRequest->setName($name);

        return $pullRequest;
    }
}
