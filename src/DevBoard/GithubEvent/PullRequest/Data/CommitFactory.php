<?php
namespace DevBoard\GithubEvent\PullRequest\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;

/**
 * Class CommitFactory.
 */
class CommitFactory
{
    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return Commit
     */
    public function create(PullRequestPayload $pullRequestPayload)
    {
        $data = $pullRequestPayload->getHeadCommitDetails();

        return new Commit(
            $data['sha'],
            new DateTime(),
            new DateTime(),
            'Unknown, PR doesnt send commit details'
        );
    }
}
