<?php
namespace DevBoard\Github\Branch\Mapper;

use DevBoard\Github\Branch\Entity\GithubBranch;
use NullDev\GithubApi\Branch\GithubBranchDataInterface;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubBranchDataInterface $remote
     * @param GithubBranch              $entity
     *
     * @return bool
     */
    public function map(GithubBranchDataInterface $remote, GithubBranch $entity)
    {
        $entity->setName($remote->getName());

        return true;
    }
}
