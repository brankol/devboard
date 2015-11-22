<?php
namespace DevBoard\GithubEvent\Push\Branch;

use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;

/**
 * Class BranchPayload.
 */
class BranchPayload
{
    private $repo;
    private $branch;
    private $lastCommit;
    private $lastCommitAuthor;
    private $lastCommitCommitter;

    /**
     * BranchPayload constructor.
     *
     * @param Repo            $repo
     * @param Branch          $branch
     * @param Commit          $lastCommit
     * @param CommitAuthor    $lastCommitAuthor
     * @param CommitCommitter $lastCommitCommitter
     */
    public function __construct(
        Repo $repo,
        Branch $branch,
        Commit $lastCommit,
        CommitAuthor $lastCommitAuthor,
        CommitCommitter $lastCommitCommitter
    ) {
        $this->repo                = $repo;
        $this->branch              = $branch;
        $this->lastCommit          = $lastCommit;
        $this->lastCommitAuthor    = $lastCommitAuthor;
        $this->lastCommitCommitter = $lastCommitCommitter;
    }
}
