<?php
namespace DevBoard\GithubRemote\ValueObject\PullRequest;

use DateTime;
use NullDev\GithubApi\PullRequest\GithubPullRequestDataInterface;

/**
 * Class PullRequest.
 */
class PullRequest implements GithubPullRequestDataInterface
{
    /** @var int */
    private $number;

    /** @var string */
    private $title;

    /** @var string */
    private $body;

    /** @var int */
    private $state;

    /** @var bool */
    private $locked;

    /** @var bool */
    private $merged;

    /** @var DateTime */
    private $githubCreatedAt;

    /** @var DateTime */
    private $githubUpdatedAt;

    /**
     * PullRequest constructor.
     *
     * @param int      $number
     * @param string   $title
     * @param string   $body
     * @param int      $state
     * @param bool     $locked
     * @param bool     $merged
     * @param DateTime $githubCreatedAt
     * @param DateTime $githubUpdatedAt
     */
    public function __construct(
        $number,
        $title,
        $body,
        $state,
        $locked,
        $merged,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt
    ) {
        $this->number          = $number;
        $this->title           = $title;
        $this->body            = $body;
        $this->state           = $state;
        $this->locked          = $locked;
        $this->merged          = $merged;
        $this->githubCreatedAt = $githubCreatedAt;
        $this->githubUpdatedAt = $githubUpdatedAt;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**  @return string */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @return bool
     */
    public function isMerged()
    {
        return $this->merged;
    }

    /**
     * @return DateTime
     */
    public function getGithubCreatedAt()
    {
        return $this->githubCreatedAt;
    }

    /**
     * @return DateTime
     */
    public function getGithubUpdatedAt()
    {
        return $this->githubUpdatedAt;
    }
}
