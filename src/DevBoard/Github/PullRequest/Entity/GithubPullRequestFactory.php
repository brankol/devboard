<?php
namespace DevBoard\Github\PullRequest\Entity;

use DevBoard\Github\PullRequest\GithubPullRequestState;
use DevBoard\Github\PullRequest\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;

/**
 * Class GithubPullRequestFactory.
 */
class GithubPullRequestFactory
{
    private $mapper;

    /**
     * GithubPullRequestFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param GithubRepo  $githubRepo
     * @param PullRequest $pullRequestValueObject
     *
     * @return GithubPullRequest
     */
    public function createFromValueObject(GithubRepo $githubRepo, PullRequest $pullRequestValueObject)
    {
        $githubPullRequest = new GithubPullRequest();
        $githubPullRequest->setRepo($githubRepo);
        $githubPullRequest->setNumber($pullRequestValueObject->getNumber());
        $githubPullRequest->setTitle($pullRequestValueObject->getTitle());
        $githubPullRequest->setBody($pullRequestValueObject->getBody());
        $githubPullRequest->setState(GithubPullRequestState::convert((int) $pullRequestValueObject->getState()));
        $githubPullRequest->setLocked($pullRequestValueObject->isLocked());
        $githubPullRequest->setMerged($pullRequestValueObject->isMerged());
        $githubPullRequest->setGithubCreatedAt($pullRequestValueObject->getGithubCreatedAt());
        $githubPullRequest->setGithubUpdatedAt($pullRequestValueObject->getGithubUpdatedAt());

        $this->mapper->map($pullRequestValueObject, $githubPullRequest);

        return $githubPullRequest;
    }
}
