<?php
namespace DevBoard\Github\User\Mapper;

use DevBoard\Github\User\Entity\GithubUser;
use NullDev\GithubApi\User\GithubUserData;
use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubUserData|GithubUserDataInterface $remote
     * @param GithubUser                             $entity
     *
     * @return bool
     */
    public function map(GithubUserDataInterface $remote, GithubUser $entity)
    {
        if (null !== $remote->getGithubId()) {
            $entity->setGithubId($remote->getGithubId());
        }
        $entity->setUsername($remote->getUsername());

        if (null !== $remote->getEmail()) {
            $entity->setEmail($remote->getEmail());
        }
        if (null !== $remote->getName()) {
            $entity->setName($remote->getName());
        }
        if (null !== $remote->getAvatarUrl()) {
            $entity->setAvatarUrl($remote->getAvatarUrl());
        }

        return true;
    }
}
