<?php
namespace DevBoard\Github\Repo\Mapper;

use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\Repo\GithubRepoData;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubRepoData $remote
     * @param GithubRepo     $entity
     *
     * @return bool
     */
    public function map(GithubRepoData $remote, GithubRepo $entity)
    {
        $entity->setGithubId($remote->getGithubId());
        $entity->setOwner($remote->getOwner());
        $entity->setName($remote->getName());
        $entity->setFullName($remote->getFullName());
        $entity->setHtmlUrl($remote->getHtmlUrl());
        $entity->setDescription($remote->getDescription());
        $entity->setFork($remote->getFork());
        $entity->setDefaultBranch($remote->getDefaultBranch());
        $entity->setGithubPrivate($remote->getGithubPrivate());
        $entity->setGitUrl($remote->getGitUrl());
        $entity->setSshUrl($remote->getSshUrl());
        $entity->setGithubCreatedAt($remote->getGithubCreatedAt());
        $entity->setGithubUpdatedAt($remote->getGithubUpdatedAt());
        $entity->setGithubPushedAt($remote->getGithubPushedAt());

        return true;
    }
}
