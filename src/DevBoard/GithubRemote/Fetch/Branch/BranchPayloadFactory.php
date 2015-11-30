<?php
namespace DevBoard\GithubRemote\Fetch\Branch;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\Fetch\Branch\Data\BranchFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitFactory;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class BranchPayloadFactory.
 */
class BranchPayloadFactory
{
    private $branchFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    /**
     * BranchPayloadFactory constructor.
     *
     * @param BranchFactory          $branchFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     */
    public function __construct(
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->branchFactory          = $branchFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
    }

    /**
     * @param GithubRepo       $githubRepo
     * @param GithubBranchData $githubBranchData
     *
     * @return BranchPayload
     */
    public function create(GithubRepo $githubRepo, GithubBranchData $githubBranchData)
    {
        return new BranchPayload(
            $githubRepo,
            $this->branchFactory->create($githubBranchData),
            $this->commitFactory->create($githubBranchData),
            $this->commitAuthorFactory->create($githubBranchData),
            $this->commitCommitterFactory->create($githubBranchData)

        );
    }
}
