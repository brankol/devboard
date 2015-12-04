<?php
namespace DevBoard\GithubEvent\Status\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;

/**
 * Class RepoFactory.
 */
class RepoFactory
{
    /**
     * @param StatusPayload $statusPayload
     *
     * @return Repo
     */
    public function create(StatusPayload $statusPayload)
    {
        $data = $statusPayload->getRepositoryDetails();

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
