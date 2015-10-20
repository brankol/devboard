<?php
namespace DevBoard\Github\Branch;

use DevBoard\Github\Commit\GithubCommit;
use DevBoard\Github\Repo\GithubRepo;
use Doctrine\ORM\Mapping as ORM;

/**
 * GithubBranch.
 *
 * @ORM\Table(name="GithubBranches")
 * @ORM\Entity(repositoryClass="DevBoard\Github\Branch\GithubBranchRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class GithubBranch
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
     * @ORM\ManyToOne(targetEntity="DevBoard\Github\Repo\GithubRepo",inversedBy="branches")
     * @ORM\JoinColumn(name="repoId",referencedColumnName="id")
     */
    private $repo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="DevBoard\Github\Commit\GithubCommit",cascade={"persist"})
     * @ORM\JoinColumn(name="lastCommitId", referencedColumnName="id")
     **/
    private $lastCommit;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param mixed $repo
     *
     * @return $this
     */
    public function setRepo(GithubRepo $repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return GithubBranch
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
     * @return mixed
     */
    public function getLastCommit()
    {
        return $this->lastCommit;
    }

    /**
     * @param mixed $lastCommit
     *
     * @return $this
     */
    public function setLastCommit(GithubCommit $lastCommit)
    {
        $this->lastCommit = $lastCommit;

        return $this;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return GithubBranch
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
     * @return GithubBranch
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
        return $this->getName();
    }
}
