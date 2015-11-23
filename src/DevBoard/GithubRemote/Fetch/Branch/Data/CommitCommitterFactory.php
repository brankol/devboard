<?php
namespace DevBoard\GithubRemote\Fetch\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class CommitCommitterFactory.
 */
class CommitCommitterFactory
{
    /**
     * @param PushPayload|GithubBranchData $githubBranchData
     *
     * @return CommitCommitter
     */
    public function create(GithubBranchData $githubBranchData)
    {
        $data = $githubBranchData->getCommitData();

        return new CommitCommitter(
            $data['commit']['committer']['name'],
            $data['commit']['committer']['email'],
            $data['committer']['login']
        );
    }
}
