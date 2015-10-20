<?php
namespace DevBoard\Github\Repo;

use DevBoard\Core\Project\Project;
use DevBoard\Github\Branch\GithubBranch;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GithubRepo.
 *
 * @ORM\Table(name="GithubRepos")
 * @ORM\Entity(repositoryClass="DevBoard\Github\Repo\GithubRepoRepository")
 * @UniqueEntity("fullName")
 * @ORM\HasLifecycleCallbacks()
 */
class GithubRepo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="githubId", type="integer")
     */
    private $githubId;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255,unique=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlUrl", type="string", length=255)
     */
    private $htmlUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="fork", type="integer")
     */
    private $fork;

    /**
     * @var string
     *
     * @ORM\Column(name="defaultBranch", type="string", length=255)
     */
    private $defaultBranch;

    /**
     * @var int
     *
     * @ORM\Column(name="githubPrivate", type="integer")
     */
    private $githubPrivate;

    /**
     * @var string
     *
     * @ORM\Column(name="gitUrl", type="string", length=255)
     */
    private $gitUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="sshUrl", type="string", length=255)
     */
    private $sshUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="githubCreatedAt", type="datetime")
     */
    private $githubCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="githubUpdatedAt", type="datetime")
     */
    private $githubUpdatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="githubPushedAt", type="datetime")
     */
    private $githubPushedAt;

    /**
     * @ORM\ManyToMany(targetEntity="DevBoard\Core\Project\Project", mappedBy="githubRepos")
     */
    protected $projects;

    /**
     * @ORM\OneToMany(targetEntity="DevBoard\Github\Branch\GithubBranch", mappedBy="repo")
     */
    protected $branches;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     *
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->branches = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @param \DateTime $githubCreatedAt
     *
     * @return GithubRepo
     */
    public function setGithubCreatedAt(\DateTime $githubCreatedAt)
    {
        $this->githubCreatedAt = $githubCreatedAt;

        return $this;
    }

    /**
     * Get githubCreatedAt.
     *
     * @return \DateTime
     */
    public function getGithubCreatedAt()
    {
        return $this->githubCreatedAt;
    }

    /**
     * Set githubUpdatedAt.
     *
     * @param \DateTime $githubUpdatedAt
     *
     * @return GithubRepo
     */
    public function setGithubUpdatedAt(\DateTime $githubUpdatedAt)
    {
        $this->githubUpdatedAt = $githubUpdatedAt;

        return $this;
    }

    /**
     * Get githubUpdatedAt.
     *
     * @return \DateTime
     */
    public function getGithubUpdatedAt()
    {
        return $this->githubUpdatedAt;
    }

    /**
     * Set githubPushedAt.
     *
     * @param \DateTime $githubPushedAt
     *
     * @return GithubRepo
     */
    public function setGithubPushedAt(\DateTime $githubPushedAt)
    {
        $this->githubPushedAt = $githubPushedAt;

        return $this;
    }

    /**
     * Get githubPushedAt.
     *
     * @return \DateTime
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
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return GithubRepo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return GithubRepo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * @ORM\PrePersist
     */
    public function doCreatedValue()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function doUpdatedValue()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
