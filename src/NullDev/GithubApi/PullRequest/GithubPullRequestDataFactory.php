<?php
namespace NullDev\GithubApi\PullRequest;

/**
 * Class GithubPullRequestDataFactory.
 */
class GithubPullRequestDataFactory
{
    /**
     * @param array $inputData
     *
     * @return GithubPullRequestData
     */
    public function create(array $inputData)
    {
        $name   = $inputData['name'];
        $commit = $inputData['commit'];

        return new GithubPullRequestData(
            $name,
            $commit
        );
    }
}
