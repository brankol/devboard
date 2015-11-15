<?php
namespace NullDev\GithubApi\Repo;

use DateTime;

/**
 * Class GithubRepoData.
 */
class GithubRepoData implements GithubRepoDataInterface
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
     * GithubRepoData constructor.
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
     * Get githubId.
     *
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get fullName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Get htmlUrl.
     *
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get fork.
     *
     * @return int
     */
    public function getFork()
    {
        return $this->fork;
    }

    /**
     * Get defaultBranch.
     *
     * @return string
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    /**
     * Get githubPrivate.
     *
     * @return int
     */
    public function getGithubPrivate()
    {
        return $this->githubPrivate;
    }

    /**
     * Get gitUrl.
     *
     * @return string
     */
    public function getGitUrl()
    {
        return $this->gitUrl;
    }

    /**
     * Get sshUrl.
     *
     * @return string
     */
    public function getSshUrl()
    {
        return $this->sshUrl;
    }

    /**
     * Get githubCreatedAt.
     *
     * @return DateTime
     */
    public function getGithubCreatedAt()
    {
        return $this->githubCreatedAt;
    }

    /**
     * Get githubUpdatedAt.
     *
     * @return DateTime
     */
    public function getGithubUpdatedAt()
    {
        return $this->githubUpdatedAt;
    }

    /**
     * Get githubPushedAt.
     *
     * @return DateTime
     */
    public function getGithubPushedAt()
    {
        return $this->githubPushedAt;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
