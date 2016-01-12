<?php
namespace DevBoard\Core\CreateProject;

use DevBoard\GithubRemote\ValueObject\Organization\OrganizationInfo;

/**
 * Class OrganizationContainer.
 */
class OrganizationContainer
{
    /** @var OrganizationInfo */
    protected $owner;
    /** @var RepositoryCollection */
    protected $repositories;

    /**
     * OrganizationContainer constructor.
     *
     * @param OrganizationInfo     $owner
     * @param RepositoryCollection $repositories
     */
    public function __construct(OrganizationInfo $owner, RepositoryCollection $repositories)
    {
        $this->owner        = $owner;
        $this->repositories = $repositories;
    }

    /**
     * @return OrganizationInfo
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
        return $this->getOwner()->getOrganizationName();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getRepositories()->count();
    }
}
