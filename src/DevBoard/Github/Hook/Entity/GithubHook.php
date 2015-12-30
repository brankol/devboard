<?php
namespace DevBoard\Github\Hook\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\Mapping as ORM;
use Resources\Entity\BaseEntity;

/**
 * GithubHook.
 */
class GithubHook extends BaseEntity
{
    /** @var GithubRepo */
    private $repo;

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
}
