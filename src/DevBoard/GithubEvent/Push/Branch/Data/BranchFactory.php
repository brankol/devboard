<?php
namespace DevBoard\GithubEvent\Push\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;

/**
 * Class BranchFactory.
 */
class BranchFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return Branch
     */
    public function create(PushPayload $pushPayload)
    {
        return new Branch(
            $pushPayload->getBranchName()
        );
    }
}
