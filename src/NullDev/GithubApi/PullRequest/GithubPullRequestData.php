<?php
namespace NullDev\GithubApi\PullRequest;

/**
 * Class GithubPullRequestData.
 */
class GithubPullRequestData implements GithubPullRequestDataInterface
{
    private $title;
    private $commitData;

    /**
     * GithubPullRequestData constructor.
     *
     * @param string $title
     * @param array  $commitData
     */
    public function __construct($title, array $commitData)
    {
        $this->title      = $title;
        $this->commitData = $commitData;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getCommitData()
    {
        return $this->commitData;
    }
}
