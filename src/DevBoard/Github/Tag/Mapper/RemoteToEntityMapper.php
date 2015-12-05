<?php
namespace DevBoard\Github\Tag\Mapper;

use DevBoard\Github\Tag\Entity\GithubTag;
use NullDev\GithubApi\Tag\GithubTagDataInterface;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubTagDataInterface $remote
     * @param GithubTag              $entity
     *
     * @return bool
     */
    public function map(GithubTagDataInterface $remote, GithubTag $entity)
    {
        $entity->setName($remote->getName());

        return true;
    }
}
