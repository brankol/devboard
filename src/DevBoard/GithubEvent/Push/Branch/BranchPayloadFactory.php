<?php
namespace DevBoard\GithubEvent\Push\Branch;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Branch\Data\BranchFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Branch\Data\RepoFactory;

/**
 * Class BranchPayloadFactory.
 */
class BranchPayloadFactory
{
    private $repoFactory;
    private $branchFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    /**
     * BranchPayloadFactory constructor.
     *
     * @param RepoFactory            $repoFactory
     * @param BranchFactory          $branchFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     */
    public function __construct(
        RepoFactory $repoFactory,
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->repoFactory            = $repoFactory;
        $this->branchFactory          = $branchFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return BranchPayload
     */
    public function create(PushPayload $pushPayload)
    {
        return new BranchPayload(
            $this->repoFactory->create($pushPayload),
            $this->branchFactory->create($pushPayload),
            $this->commitFactory->create($pushPayload),
            $this->commitAuthorFactory->create($pushPayload),
            $this->commitCommitterFactory->create($pushPayload)

        );
    }
}
