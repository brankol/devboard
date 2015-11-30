<?php
namespace DevBoard\GithubRemote\ValueObject\Commit;

use DateTime;
use NullDev\GithubApi\Commit\GithubCommitDataInterface;

/**
 * Class Commit.
 */
class Commit implements GithubCommitDataInterface
{
    private $sha;
    private $authorDate;
    private $committerDate;
    private $message;

    /**
     * Commit constructor.
     *
     * @param string   $sha
     * @param DateTime $authorDate
     * @param DateTime $committerDate
     * @param string   $message
     */
    public function __construct($sha, DateTime $authorDate, DateTime $committerDate, $message)
    {
        $this->sha           = $sha;
        $this->authorDate    = $authorDate;
        $this->committerDate = $committerDate;
        $this->message       = $message;
    }

    /**
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * @return DateTime
     */
    public function getAuthorDate()
    {
        return $this->authorDate;
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
}
