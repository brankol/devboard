<?php
namespace DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\PullRequestCreator;

/**
 * Class PullRequestCreatorFactory.
 */
class PullRequestCreatorFactory
{
    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return CommitAuthor
     */
    public function create(PullRequestPayload $pullRequestPayload)
    {
        $data = $pullRequestPayload->getPullRequestCreatorDetails();

        return new PullRequestCreator(
            $data['id'],
            $data['login'],
            $data['avatar_url']
        );
    }
}
