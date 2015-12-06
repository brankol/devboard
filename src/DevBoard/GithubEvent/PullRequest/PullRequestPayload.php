<?php
namespace DevBoard\GithubEvent\PullRequest;

use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;

/**
 * Class PullRequestPayload.
 */
class PullRequestPayload
{
    private $repo;
    private $pullRequest;
    private $lastCommit;
    private $lastCommitAuthor;
    private $lastCommitCommitter;

    /**
     * PullRequestPayload constructor.
     *
     * @param Repo            $repo
     * @param PullRequest     $pullRequest
     * @param Commit          $lastCommit
     * @param CommitAuthor    $lastCommitAuthor
     * @param CommitCommitter $lastCommitCommitter
     */
    public function __construct(
        Repo $repo,
        PullRequest $pullRequest,
        Commit $lastCommit,
        CommitAuthor $lastCommitAuthor,
        CommitCommitter $lastCommitCommitter
    ) {
        $this->repo                = $repo;
        $this->pullRequest         = $pullRequest;
        $this->lastCommit          = $lastCommit;
        $this->lastCommitAuthor    = $lastCommitAuthor;
        $this->lastCommitCommitter = $lastCommitCommitter;
    }
}
