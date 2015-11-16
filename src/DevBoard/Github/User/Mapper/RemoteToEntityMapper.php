<?php
namespace DevBoard\Github\User\Mapper;

use DevBoard\Github\User\Entity\GithubUser;
use NullDev\GithubApi\User\GithubUserData;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubUserData $remote
     * @param GithubUser     $entity
     *
     * @return bool
     */
    public function map(GithubUserData $remote, GithubUser $entity)
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
