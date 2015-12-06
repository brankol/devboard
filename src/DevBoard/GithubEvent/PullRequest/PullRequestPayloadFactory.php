<?php
namespace DevBoard\GithubEvent\PullRequest;

use DevBoard\GithubEvent\Payload;
use DevBoard\GithubEvent\PullRequest\Data\CommitFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestAssigneeFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestCreatorFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestFactory;
use DevBoard\GithubEvent\PullRequest\Data\RepoFactory;

/**
 * Class PullRequestPayloadFactory.
 */
class PullRequestPayloadFactory
{
    private $repoFactory;
    private $pullRequestFactory;
    private $commitFactory;
    private $pullRequestCreatorFactory;
    private $pullRequestAssigneeFactory;

    /**
     * PullRequestPayloadFactory constructor.
     *
     * @param RepoFactory                $repoFactory
     * @param PullRequestFactory         $pullRequestFactory
     * @param CommitFactory              $commitFactory
     * @param PullRequestCreatorFactory  $pullRequestCreatorFactory
     * @param PullRequestAssigneeFactory $pullRequestAssigneeFactory
     */
    public function __construct(
        RepoFactory $repoFactory,
        PullRequestFactory $pullRequestFactory,
        CommitFactory $commitFactory,
        PullRequestCreatorFactory $pullRequestCreatorFactory,
        PullRequestAssigneeFactory $pullRequestAssigneeFactory
    ) {
        $this->repoFactory                = $repoFactory;
        $this->pullRequestFactory         = $pullRequestFactory;
        $this->commitFactory              = $commitFactory;
        $this->pullRequestCreatorFactory  = $pullRequestCreatorFactory;
        $this->pullRequestAssigneeFactory = $pullRequestAssigneeFactory;
    }

    /**
     * @param Payload\PullRequestPayload|PullRequestPayload $pullRequestPayload
     *
     * @return PullRequestPayload
     */
    public function create(Payload\PullRequestPayload $pullRequestPayload)
    {
        return new PullRequestPayload(
            $this->repoFactory->create($pullRequestPayload),
            $this->pullRequestFactory->create($pullRequestPayload),
            $this->commitFactory->create($pullRequestPayload),
            $this->pullRequestCreatorFactory->create($pullRequestPayload),
            $this->pullRequestAssigneeFactory->create($pullRequestPayload)

        );
    }
}
