<?php
namespace DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use DevBoard\GithubRemote\ValueObject\User\PullRequestAssignee;

/**
 * Class PullRequestAssigneeFactory.
 */
class PullRequestAssigneeFactory
{
    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return CommitCommitter
     */
    public function create(PullRequestPayload $pullRequestPayload)
    {
        $data = $pullRequestPayload->getPullRequestAssigneeDetails();

        return new PullRequestAssignee(
            $data['id'],
            $data['login'],
            $data['avatar_url']
        );
    }
}
