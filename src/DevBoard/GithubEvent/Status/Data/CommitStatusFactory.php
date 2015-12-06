<?php
namespace DevBoard\GithubEvent\Status\Data;

use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubRemote\ValueObject\CommitStatus\CommitStatus;

/**
 * Class CommitStatusFactory.
 */
class CommitStatusFactory
{
    /**
     * @param StatusPayload $statusPayload
     *
     * @return CommitStatus
     */
    public function create(StatusPayload $statusPayload)
    {
        return new CommitStatus(
            $statusPayload->getState(),
            $statusPayload->getDescription(),
            $statusPayload->getTargetUrl()
        );
    }
}
