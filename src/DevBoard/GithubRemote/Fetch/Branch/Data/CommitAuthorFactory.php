<?php
namespace DevBoard\GithubRemote\Fetch\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class CommitAuthorFactory.
 */
class CommitAuthorFactory
{
    /**
     * @param PushPayload|GithubBranchData $githubBranchData
     *
     * @return CommitAuthor
     */
    public function create(GithubBranchData $githubBranchData)
    {
        $data = $githubBranchData->getCommitData();

        return new CommitAuthor(
            $data['commit']['author']['name'],
            $data['commit']['author']['email'],
            $data['author']['login']
        );
    }
}
