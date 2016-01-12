<?php
namespace DevBoard\GithubRemote\ValueObject\Repo;

use NullDev\GithubApi\Repo\GithubRepoDataInterface;

/**
 * Class RepoInfo.
 */
class RepoInfo implements GithubRepoDataInterface
{
    /** @var string */
    private $owner;

    /** @var string */
    private $name;

    /**
     * Repo constructor.
     *
     * @param string $owner
     * @param string $name
     */
    public function __construct(
        $owner,
        $name
    ) {
        $this->owner = $owner;
        $this->name  = $name;
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
        return $this->getOwner().'/'.$this->getName();
    }
}
