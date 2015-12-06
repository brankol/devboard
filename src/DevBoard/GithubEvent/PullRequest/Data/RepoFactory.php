<?php
namespace DevBoard\GithubEvent\PullRequest\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;

/**
 * Class RepoFactory.
 */
class RepoFactory
{
    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return Repo
     */
    public function create(PullRequestPayload $pullRequestPayload)
    {
        $data = $pullRequestPayload->getRepositoryDetails();

        return new Repo(
            $data['id'],
            $data['owner']['login'],
            $data['name'],
            $data['full_name'],
            $data['html_url'],
            $data['description'],
            $data['fork'],
            $data['default_branch'],
            $data['private'],
            $data['git_url'],
            $data['ssh_url'],
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            new DateTime($data['pushed_at'])
        );
    }
}
