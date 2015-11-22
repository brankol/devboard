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
    private $timestamp;
    private $message;

    /**
     * Commit constructor.
     *
     * @param string    $sha
     * @param \DateTime $timestamp
     * @param string    $message
     */
    public function __construct($sha, DateTime $timestamp, $message)
    {
        $this->sha       = $sha;
        $this->timestamp = $timestamp;
        $this->message   = $message;
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
        return $this->timestamp;
    }

    /**
     * @return DateTime
     */
    public function getCommitterDate()
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
