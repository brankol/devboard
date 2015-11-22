<?php
namespace DevBoard\Github\Commit\Mapper;

use DevBoard\Github\Commit\Entity\GithubCommit;
use NullDev\GithubApi\Commit\GithubCommitDataInterface;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubCommitDataInterface $remote
     * @param GithubCommit              $entity
     *
     * @return bool
     */
    public function map(GithubCommitDataInterface $remote, GithubCommit $entity)
    {
        $entity->setSha($remote->getSha());
        $entity->setAuthorDate($remote->getAuthorDate());
        $entity->setCommitterDate($remote->getCommitterDate());
        $entity->setMessage($remote->getMessage());

        return true;
    }
}
