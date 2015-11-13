<?php
namespace DevBoard\Core\Project\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use NullDev\UserBundle\Entity\User;
use Resources\Entity\BaseEntity;

/**
 * Project.
 *
 * @ORM\Table(name="Projects")
 * @ORM\Entity(repositoryClass="DevBoard\Core\Project\Entity\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project extends BaseEntity
{
    /** @var string */
    private $projectName;

    /** @var int */
    private $active = 1;

    /** ArrayCollection */
    protected $githubRepos;

    /** User */
    protected $user;

    /**
     *
     */
    public function __construct()
    {
        $this->githubRepos = new ArrayCollection();
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
     * @return string
     */
    public function __toString()
    {
        return $this->getProjectName();
    }
}
