<?php
namespace DevBoard\Core\CreateProject;

use DevBoard\GithubRemote\ValueObject\User\UserInfo;

/**
 * Class UserContainer.
 */
class UserContainer
{
    /** @var UserInfo */
    protected $owner;
    /** @var RepositoryCollection */
    protected $repositories;

    /**
     * UserContainer constructor.
     *
     * @param UserInfo             $owner
     * @param RepositoryCollection $repositories
     */
    public function __construct(UserInfo $owner, RepositoryCollection $repositories)
    {
        $this->owner        = $owner;
        $this->repositories = $repositories;
    }

    /**
     * @return UserInfo
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return RepositoryCollection
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getOwner()->getUsername();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getRepositories()->count();
    }
}
