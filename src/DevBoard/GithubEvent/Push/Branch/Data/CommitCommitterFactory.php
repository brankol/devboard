<?php
namespace DevBoard\GithubEvent\Push\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;

/**
 * Class CommitCommitterFactory.
 */
class CommitCommitterFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return CommitCommitter
     */
    public function create(PushPayload $pushPayload)
    {
        $data = $pushPayload->getCommitCommiterDetails();

        return new CommitCommitter(
            $data['name'],
            $data['email'],
            $data['username']
        );
    }
}
