<?php
namespace DevBoard\Github\Repo\Entity;

use DateTime;
use DevBoard\Core\Project\Entity\Project;
use DevBoard\Github\Branch\Entity\GithubBranch;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use Resources\Entity\BaseEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GithubRepo.
 *
 * @UniqueEntity("fullName")
 */
class GithubRepo extends BaseEntity implements GithubRepoDataInterface
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

    /** @var ArrayCollection */
    protected $projects;

    /** @var ArrayCollection */
    protected $branches;

    /**
     *
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->branches = new ArrayCollection();
    }

    /**
     * Set githubId.
     *
     * @param int $githubId
     *
     * @return GithubRepo
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;

        return $this;
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
     * @param string $owner
     *
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return GithubRepo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return GithubRepo
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
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
     * Set htmlUrl.
     *
     * @param string $htmlUrl
     *
     * @return GithubRepo
     */
    public function setHtmlUrl($htmlUrl)
    {
        $this->htmlUrl = $htmlUrl;

        return $this;
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
     * Set description.
     *
     * @param string $description
     *
     * @return GithubRepo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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
     * Set fork.
     *
     * @param int $fork
     *
     * @return GithubRepo
     */
    public function setFork($fork)
    {
        $this->fork = $fork;

        return $this;
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
     * Set githubCreatedAt.
     *
     * @param DateTime $githubCreatedAt
     *
     * @return GithubRepo
     */
    public function setGithubCreatedAt(DateTime $githubCreatedAt)
    {
        $this->githubCreatedAt = $githubCreatedAt;

        return $this;
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
     * Set githubUpdatedAt.
     *
     * @param DateTime $githubUpdatedAt
     *
     * @return GithubRepo
     */
    public function setGithubUpdatedAt(DateTime $githubUpdatedAt)
    {
        $this->githubUpdatedAt = $githubUpdatedAt;

        return $this;
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
     * Set githubPushedAt.
     *
     * @param DateTime $githubPushedAt
     *
     * @return GithubRepo
     */
    public function setGithubPushedAt(DateTime $githubPushedAt)
    {
        $this->githubPushedAt = $githubPushedAt;

        return $this;
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
     * Set gitUrl.
     *
     * @param string $gitUrl
     *
     * @return GithubRepo
     */
    public function setGitUrl($gitUrl)
    {
        $this->gitUrl = $gitUrl;

        return $this;
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
     * Set sshUrl.
     *
     * @param string $sshUrl
     *
     * @return GithubRepo
     */
    public function setSshUrl($sshUrl)
    {
        $this->sshUrl = $sshUrl;

        return $this;
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
     * Set defaultBranch.
     *
     * @param string $defaultBranch
     *
     * @return GithubRepo
     */
    public function setDefaultBranch($defaultBranch)
    {
        $this->defaultBranch = $defaultBranch;

        return $this;
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
     * Set githubPrivate.
     *
     * @param int $githubPrivate
     *
     * @return GithubRepo
     */
    public function setGithubPrivate($githubPrivate)
    {
        $this->githubPrivate = $githubPrivate;

        return $this;
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
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $projects
     *
     * @return $this
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * @param Project $project
     *
     * @return $this
     *
     * @internal param mixed $projects
     */
    public function addProject(Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * @param mixed $branches
     *
     * @return $this
     */
    public function setBranches(ArrayCollection $branches)
    {
        $this->branches = $branches;

        return $this;
    }

    /**
     * @param GithubBranch $branch
     *
     * @return $this
     *
     * @internal param mixed $branches
     */
    public function addBranch(GithubBranch $branch)
    {
        $this->branches[] = $branch;

        return $this;
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function getBranchByName($name)
    {
        foreach ($this->branches as $branch) {
            if ($branch->getName() === $name) {
                return $branch;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
