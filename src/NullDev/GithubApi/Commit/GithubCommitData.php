<?php
namespace NullDev\GithubApi\Commit;

use DateTime;
use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\User\GithubUserData;

/**
 * Class GithubCommitData.
 */
class GithubCommitData implements GithubCommitDataInterface
{
    /** @var GithubRepo */
    protected $githubRepo;

    /** @var string */
    private $sha;

    /** @var GithubUserData */
    private $author;

    /** @var DateTime */
    private $authorDate;

    /** @var GithubUserData */
    private $committer;

    /** @var DateTime */
    private $committerDate;

    /** @var string */
    private $message;

    /** @var string */
    private $githubStatus;

    /**
     * GithubCommitData constructor.
     *
     * @param GithubRepo     $githubRepo
     * @param string         $sha
     * @param GithubUserData $author
     * @param DateTime       $authorDate
     * @param GithubUserData $committer
     * @param DateTime       $committerDate
     * @param string         $message
     * @param string         $githubStatus
     */
    public function __construct(
        GithubRepo $githubRepo,
        $sha,
        GithubUserData $author,
        DateTime $authorDate,
        GithubUserData $committer,
        DateTime $committerDate,
        $message,
        $githubStatus
    ) {
        $this->githubRepo    = $githubRepo;
        $this->sha           = $sha;
        $this->author        = $author;
        $this->authorDate    = $authorDate;
        $this->committer     = $committer;
        $this->committerDate = $committerDate;
        $this->message       = $message;
        $this->githubStatus  = $githubStatus;
    }

    /**
     * @return GithubRepo
     */
    public function getGithubRepo()
    {
        return $this->githubRepo;
    }

    /**
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * @return GithubUserData
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return DateTime
     */
    public function getAuthorDate()
    {
        return $this->authorDate;
    }

    /**
     * @return GithubUserData
     */
    public function getCommitter()
    {
        return $this->committer;
    }

    /**
     * @return DateTime
     */
    public function getCommitterDate()
    {
        return $this->committerDate;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getGithubStatus()
    {
        return $this->githubStatus;
    }
}
