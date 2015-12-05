<?php
namespace DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;

/**
 * Class CommitAuthorFactory.
 */
class CommitAuthorFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return CommitAuthor
     */
    public function create(PushPayload $pushPayload)
    {
        $data = $pushPayload->getCommitAuthorDetails();

        return new CommitAuthor(
            $data['name'],
            $data['email'],
            $data['username']
        );
    }
}
