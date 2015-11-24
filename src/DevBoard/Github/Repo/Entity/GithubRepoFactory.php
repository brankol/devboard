<?php
namespace DevBoard\Github\Repo\Entity;

use DevBoard\Github\Repo\Mapper\RemoteToEntityMapper;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;

/**
 * Class GithubRepoFactory.
 */
class GithubRepoFactory
{
    private $mapper;

    /**
     * GithubRepoFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param string $fullName
     *
     * @return GithubRepo
     */
    public function create($fullName)
    {
        list($owner, $name) = explode('/', $fullName);

        $githubRepo = new GithubRepo();
        $githubRepo->setOwner($owner);
        $githubRepo->setName($name);

        return $githubRepo;
    }

    /**
     * @param Repo|GithubRepoDataInterface $repoValueObject
     *
     * @return GithubRepo
     */
    public function createFromValueObject(GithubRepoDataInterface $repoValueObject)
    {
        $githubRepo = new GithubRepo();

        $this->mapper->map($repoValueObject, $githubRepo);

        return $githubRepo;
    }
}
