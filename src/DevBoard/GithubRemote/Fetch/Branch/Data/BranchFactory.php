<?php
namespace DevBoard\GithubRemote\Fetch\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class BranchFactory.
 */
class BranchFactory
{
    /**
     * @param PushPayload|GithubBranchData $githubBranchData
     *
     * @return Branch
     */
    public function create(GithubBranchData $githubBranchData)
    {
        return new Branch(
            $githubBranchData->getName()
        );
    }
}
