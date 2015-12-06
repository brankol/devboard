<?php
namespace DevBoard\GithubEvent\PullRequest\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;

/**
 * Class PullRequestFactory.
 */
class PullRequestFactory
{
    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return PullRequest
     */
    public function create(PullRequestPayload $pullRequestPayload)
    {
        $data = $pullRequestPayload->getPullRequestDetails();

        return new PullRequest(
            $data['number'],
            $data['title'],
            $data['body'],
            $data['state'],
            $data['locked'],
            $data['merged'],
            new DateTime($data['created_at']),
            new DateTime($data['updated_at'])

        );
    }
}
