<?php
namespace DevBoard\Github\Commit\Entity;

use DateTime;
use DevBoard\Github\Commit\InternalStatus;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\Entity\GithubUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use NullDev\GithubApi\Commit\GithubCommitDataInterface;
use Resources\Entity\BaseEntity;

/**
 * GithubCommit.
 */
class GithubCommit extends BaseEntity implements GithubCommitDataInterface
{
    /** @var GithubRepo */
    protected $githubRepo;

    /** @var string */
    private $sha;

    /** @var GithubUser */
    private $author;

    /** @var DateTime */
    private $authorDate;

    /** @var GithubUser */
    private $committer;

    /** @var DateTime */
    private $committerDate;

    /** @var string */
    private $message;

    /** @var string */
    private $internalStatus = InternalStatus::FINISHED_NO_STATUS_CHECKS;

    /** @var string */
    private $githubStatus;

    /** @var ArrayCollection */
    private $commitStatuses;

    /**
     * GithubCommit constructor.
     */
    public function __construct()
    {
        $this->commitStatuses = new ArrayCollection();
    }

    /**
     * @return GithubRepo
     */
    public function getGithubRepo()
    {
        return $this->githubRepo;
    }

    /**
     * @param GithubRepo $githubRepo
     *
     * @return $this
     */
    public function setGithubRepo(GithubRepo $githubRepo)
    {
        $this->githubRepo = $githubRepo;

        return $this;
    }

    /**
     * Set sha.
     *
     * @param string $sha
     *
     * @return GithubCommit
     */
    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    /**
     * Get sha.
     *
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * Set author.
     *
     * @param GithubUser $author
     *
     * @return GithubCommit
     */
    public function setAuthor(GithubUser $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return GithubUser
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set authorDate.
     *
     * @param DateTime $authorDate
     *
     * @return GithubCommit
     */
    public function setAuthorDate($authorDate)
    {
        $this->authorDate = $authorDate;

        return $this;
    }

    /**
     * Get authorDate.
     *
     * @return DateTime
     */
    public function getAuthorDate()
    {
        return $this->authorDate;
    }

    /**
     * Set committer.
     *
     * @param GithubUser $committer
     *
     * @return GithubCommit
     */
    public function setCommitter(GithubUser $committer)
    {
        $this->committer = $committer;

        return $this;
    }

    /**
     * Get committer.
     *
     * @return GithubUser
     */
    public function getCommitter()
    {
        return $this->committer;
    }

    /**
     * Set committerDate.
     *
     * @param DateTime $committerDate
     *
     * @return GithubCommit
     */
    public function setCommitterDate($committerDate)
    {
        $this->committerDate = $committerDate;

        return $this;
    }

    /**
     * Get committerDate.
     *
     * @return DateTime
     */
    public function getCommitterDate()
    {
        return $this->committerDate;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return GithubCommit
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getInternalStatus()
    {
        return $this->internalStatus;
    }

    /**
     * @param string $internalStatus
     *
     * @return $this
     */
    public function setInternalStatus($internalStatus)
    {
        $this->internalStatus = $internalStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getGithubStatus()
    {
        return $this->githubStatus;
    }

    /**
     * @param string $githubStatus
     *
     * @return $this
     */
    public function setGithubStatus($githubStatus)
    {
        $this->githubStatus = $githubStatus;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCommitStatuses()
    {
        return $this->commitStatuses;
    }

    /**
     * @param ArrayCollection $commitStatuses
     */
    public function setCommitStatuses(ArrayCollection $commitStatuses)
    {
        $this->commitStatuses = $commitStatuses;
    }

    /**
     * @return string
     */
    public function getInternalStatusText()
    {
        return InternalStatus::getText($this->internalStatus);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
