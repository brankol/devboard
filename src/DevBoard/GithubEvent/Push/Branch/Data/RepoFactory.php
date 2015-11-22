<?php
namespace DevBoard\GithubEvent\Push\Branch\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;

/**
 * Class RepoFactory.
 */
class RepoFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return Repo
     */
    public function create(PushPayload $pushPayload)
    {
        $data = $pushPayload->getRepositoryDetails();

        return new Repo(
            $data['id'],
            $data['owner']['name'],
            $data['name'],
            $data['full_name'],
            $data['html_url'],
            $data['description'],
            $data['fork'],
            $data['default_branch'],
            $data['private'],
            $data['git_url'],
            $data['ssh_url'],
            new DateTime(strtotime($data['created_at'])),
            new DateTime($data['updated_at']),
            new DateTime(strtotime($data['pushed_at']))
        );
    }
}
