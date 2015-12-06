<?php
namespace DevBoard\Github\PullRequest\Mapper;

use DevBoard\Github\PullRequest\Entity\GithubPullRequest;
use NullDev\GithubApi\PullRequest\GithubPullRequestDataInterface;

/**
 * Class RemoteToEntityMapper.
 */
class RemoteToEntityMapper
{
    /**
     * @param GithubPullRequestDataInterface $remote
     * @param GithubPullRequest              $entity
     *
     * @return bool
     */
    public function map(GithubPullRequestDataInterface $remote, GithubPullRequest $entity)
    {
        $entity->setTitle($remote->getTitle());

        return true;
    }
}
