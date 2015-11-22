<?php
namespace DevBoard\GithubRemote\ValueObject\Repo;

use DateTime;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;

/**
 * Class Repo.
 */
class Repo implements GithubRepoDataInterface
{
    /** @var int */
    private $githubId;

    /** @var string */
    private $owner;

    /** @var string */
    private $name;

    /** @var string */
    private $fullName;

    /** @var string */
    private $htmlUrl;

    /** @var string */
    private $description;

    /** @var int */
    private $fork;

    /** @var string */
    private $defaultBranch;

    /** @var int */
    private $githubPrivate;

    /** @var string */
    private $gitUrl;

    /** @var string */
    private $sshUrl;

    /** @var DateTime */
    private $githubCreatedAt;

    /** @var DateTime */
    private $githubUpdatedAt;

    /** @var DateTime */
    private $githubPushedAt;

    /**
     * Repo constructor.
     *
     * @param int      $githubId
     * @param string   $owner
     * @param string   $name
     * @param string   $fullName
     * @param string   $htmlUrl
     * @param string   $description
     * @param int      $fork
     * @param string   $defaultBranch
     * @param int      $githubPrivate
     * @param string   $gitUrl
     * @param string   $sshUrl
     * @param DateTime $githubCreatedAt
     * @param DateTime $githubUpdatedAt
     * @param DateTime $githubPushedAt
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $githubId,
        $owner,
        $name,
        $fullName,
        $htmlUrl,
        $description,
        $fork,
        $defaultBranch,
        $githubPrivate,
        $gitUrl,
        $sshUrl,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt,
        DateTime $githubPushedAt
    ) {
        $this->githubId        = $githubId;
        $this->owner           = $owner;
        $this->name            = $name;
        $this->fullName        = $fullName;
        $this->htmlUrl         = $htmlUrl;
        $this->description     = $description;
        $this->fork            = $fork;
        $this->defaultBranch   = $defaultBranch;
        $this->githubPrivate   = $githubPrivate;
        $this->gitUrl          = $gitUrl;
        $this->sshUrl          = $sshUrl;
        $this->githubCreatedAt = $githubCreatedAt;
        $this->githubUpdatedAt = $githubUpdatedAt;
        $this->githubPushedAt  = $githubPushedAt;
    }

    /**
     * @return int
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getFork()
    {
        return $this->fork;
    }

    /**
     * @return string
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    /**
     * @return int
     */
    public function getGithubPrivate()
    {
        return $this->githubPrivate;
    }

    /**
     * @return string
     */
    public function getGitUrl()
    {
        return $this->gitUrl;
    }

    /**
     * @return string
     */
    public function getSshUrl()
    {
        return $this->sshUrl;
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

    /**
     * @return DateTime
     */
    public function getGithubPushedAt()
    {
        return $this->githubPushedAt;
    }
}
