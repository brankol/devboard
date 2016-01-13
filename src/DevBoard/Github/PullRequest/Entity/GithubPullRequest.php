<?php
namespace DevBoard\Github\PullRequest\Entity;

use DateTime;
use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\Entity\GithubUser;
use Doctrine\ORM\Mapping as ORM;
use NullDev\GithubApi\PullRequest\GithubPullRequestDataInterface;
use Resources\Entity\BaseEntity;

/**
 * GithubPullRequest.
 */
class GithubPullRequest extends BaseEntity implements GithubPullRequestDataInterface
{
    /** @var GithubRepo */
    private $repo;

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

    /** @var GithubUser */
    private $createdBy;

    /** @var GithubUser */
    private $assignedTo;

    /** @var GithubCommit */
    private $lastCommit;

    /** @var DateTime */
    private $githubCreatedAt;

    /** @var DateTime */
    private $githubUpdatedAt;

    /** @return GithubRepo */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param GithubRepo $repo
     *
     * @return $this
     */
    public function setRepo(GithubRepo $repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return GithubPullRequest
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     *
     * @return $this
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMerged()
    {
        return $this->merged;
    }

    /**
     * @param bool $merged
     *
     * @return $this
     */
    public function setMerged($merged)
    {
        $this->merged = $merged;

        return $this;
    }

    /**
     * @return GithubUser
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param GithubUser $createdBy
     *
     * @return $this
     */
    public function setCreatedBy(GithubUser $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return GithubUser
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * @param GithubUser $assignedTo
     *
     * @return $this
     */
    public function setAssignedTo(GithubUser $assignedTo)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /** @return GithubCommit */
    public function getLastCommit()
    {
        return $this->lastCommit;
    }

    /**
     * @param GithubCommit $lastCommit
     *
     * @return $this
     */
    public function setLastCommit(GithubCommit $lastCommit)
    {
        $this->lastCommit = $lastCommit;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getGithubCreatedAt()
    {
        return $this->githubCreatedAt;
    }

    /**
     * @param DateTime $githubCreatedAt
     *
     * @return $this
     */
    public function setGithubCreatedAt($githubCreatedAt)
    {
        $this->githubCreatedAt = $githubCreatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getGithubUpdatedAt()
    {
        return $this->githubUpdatedAt;
    }

    /**
     * @param DateTime $githubUpdatedAt
     *
     * @return $this
     */
    public function setGithubUpdatedAt($githubUpdatedAt)
    {
        $this->githubUpdatedAt = $githubUpdatedAt;

        return $this;
    }

    /** @return string */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return array
     */
    public function getLiveInfo()
    {
        return [
            'number'       => $this->getNumber(),
            'title'       => $this->getTitle(),
            'repo'       => $this->getRepo()->getLiveInfo(),
            'lastCommit' => $this->getLastCommit()->getLiveInfo(),
            'updatedAt'  => $this->getUpdatedAt(),
        ];
    }
}
