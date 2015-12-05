<?php
namespace DevBoard\GithubEvent\Push\Tag;

use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;

/**
 * Class TagPayload.
 */
class TagPayload
{
    private $repo;
    private $tag;
    private $lastCommit;
    private $lastCommitAuthor;
    private $lastCommitCommitter;

    /**
     * TagPayload constructor.
     *
     * @param Repo            $repo
     * @param Tag             $tag
     * @param Commit          $lastCommit
     * @param CommitAuthor    $lastCommitAuthor
     * @param CommitCommitter $lastCommitCommitter
     */
    public function __construct(
        Repo $repo,
        Tag $tag,
        Commit $lastCommit,
        CommitAuthor $lastCommitAuthor,
        CommitCommitter $lastCommitCommitter
    ) {
        $this->repo                = $repo;
        $this->tag                 = $tag;
        $this->lastCommit          = $lastCommit;
        $this->lastCommitAuthor    = $lastCommitAuthor;
        $this->lastCommitCommitter = $lastCommitCommitter;
    }
}
