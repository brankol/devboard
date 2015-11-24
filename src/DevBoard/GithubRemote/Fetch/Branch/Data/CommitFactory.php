<?php
namespace DevBoard\GithubRemote\Fetch\Branch\Data;

use DateTime;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class CommitFactory.
 */
class CommitFactory
{
    /**
     * @param PushPayload|GithubBranchData $githubBranchData
     *
     * @return Commit
     */
    public function create(GithubBranchData $githubBranchData)
    {
        $data = $githubBranchData->getCommitData();

        return new Commit(
            $data['sha'],
            new DateTime($data['commit']['author']['date']),
            new DateTime($data['commit']['committer']['date']),
            $data['commit']['message']
        );
    }
}
