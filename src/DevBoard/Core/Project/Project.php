<?php
namespace DevBoard\Core\Project;

use DevBoard\Github\Repo\GithubRepo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use NullDev\UserBundle\Entity\User;

/**
 * Project.
 *
 * @ORM\Table(name="Projects")
 * @ORM\Entity(repositoryClass="DevBoard\Core\Project\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    /**
     * @var guid
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="projectName", type="string", length=255)
     */
    private $projectName;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active = 1;

    /**
     * @ORM\ManyToMany(targetEntity="DevBoard\Github\Repo\GithubRepo", inversedBy="repos")
     * @ORM\JoinTable(name="ProjectGithubRepos")
     */
    protected $githubRepos;

    /**
     * @ORM\ManyToOne(targetEntity="NullDev\UserBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(name="userId",referencedColumnName="id")
     */
    protected $user;

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
        $this->githubRepos = new ArrayCollection();
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
     * Set projectName.
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName.
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set active.
     *
     * @param int $active
     *
     * @return Project
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function getGithubRepos()
    {
        return $this->githubRepos;
    }

    /**
     * @param mixed $githubRepos
     *
     * @return $this
     */
    public function setGithubRepos(ArrayCollection $githubRepos)
    {
        $this->githubRepos = $githubRepos;

        return $this;
    }

    /**
     * @param GithubRepo $githubRepo
     *
     * @return $this
     */
    public function addGithubRepo(GithubRepo $githubRepo)
    {
        $this->githubRepos[] = $githubRepo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Project
     */
    public function setCreatedAt(\DateTime $createdAt)
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
     * @return Project
     */
    public function setUpdatedAt(\DateTime $updatedAt)
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
        return $this->getProjectName();
    }
}
