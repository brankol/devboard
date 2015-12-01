<?php
namespace DevBoard\GithubEvent\Status\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;

/**
 * Class CommitFactory.
 */
class CommitFactory
{
    /**
     * @param StatusPayload $statusPayload
     *
     * @return Commit
     */
    public function create(StatusPayload $statusPayload)
    {
        $data = $statusPayload->getCommitDetails();

        return new Commit(
            $data['sha'],
            new DateTime($data['commit']['author']['date']),
            new DateTime($data['commit']['committer']['date']),
            $data['commit']['message']
        );
    }
}
