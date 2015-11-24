<?php
namespace DevBoard\GithubEvent\Push\Branch\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;

/**
 * Class CommitFactory.
 */
class CommitFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return Commit
     */
    public function create(PushPayload $pushPayload)
    {
        $data = $pushPayload->getHeadCommitDetails();

        return new Commit(
            $data['id'],
            new DateTime($data['timestamp']),
            new DateTime($data['timestamp']),
            $data['message']
        );
    }
}
