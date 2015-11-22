<?php
namespace DevBoard\Github\User\Entity;

use DevBoard\Github\User\Mapper\RemoteToEntityMapper;
use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class GithubUserFactory.
 */
class GithubUserFactory
{
    private $mapper;

    /**
     * GithubBranchFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param $username
     *
     * @return GithubUser
     */
    public function create($username)
    {
        $githubUser = new GithubUser();
        $githubUser->setUsername($username);

        return $githubUser;
    }

    /**
     * @param GithubUserDataInterface $userValueObject
     *
     * @return GithubUser
     */
    public function createFromValueObject(GithubUserDataInterface $userValueObject)
    {
        $githubUser = new GithubUser();

        $this->mapper->map($userValueObject, $githubUser);

        return $githubUser;
    }
}
