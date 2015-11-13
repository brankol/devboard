<?php
namespace DevBoard\Github\Branch\Entity;

use DevBoard\Github\Commit\GithubCommit;
use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\Mapping as ORM;
use Resources\Entity\BaseEntity;

/**
 * GithubBranch.
 */
class GithubBranch extends BaseEntity
{
    /** @var GithubRepo */
    private $repo;

    /** @var string */
    private $name;

    /** @var GithubCommit */
    private $lastCommit;

    /** @return GithubRepo */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param GithubRepo $repo
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

    /**  @return string */
    public function getName()
    {
        return $this->name;
    }

    /** @return GithubCommit */
    public function getLastCommit()
    {
        return $this->lastCommit;
    }

    /**
     * @param GithubCommit $lastCommit
     *
     * @return $this
     */
    public function setLastCommit(GithubCommit $lastCommit)
    {
        $this->lastCommit = $lastCommit;

        return $this;
    }

    /** @return string */
    public function __toString()
    {
        return $this->getName();
    }
}
