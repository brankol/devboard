<?php
namespace DevBoard\GithubEvent\PullRequest;

use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\PullRequest\GithubPullRequestFacade;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubEvent\PullRequest\Data\CommitFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestAssigneeFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestCreatorFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestFactory;
use DevBoard\GithubEvent\PullRequest\Data\RepoFactory;
use Doctrine\ORM\EntityManager;

/**
 * Class PullRequestHandler.
 */
class PullRequestHandler
{
    private $repoFactory;
    private $pullRequestFactory;
    private $commitFactory;
    private $pullRequestCreatorFactory;
    private $pullRequestAssigneeFactory;

    private $githubRepoFacade;
    private $githubPullRequestFacade;
    private $githubCommitFacade;
    private $githubUserFacade;
    private $em;

    /**
     * PullRequestHandler constructor.
     *
     * @param RepoFactory                $repoFactory
     * @param PullRequestFactory         $pullRequestFactory
     * @param CommitFactory              $commitFactory
     * @param PullRequestCreatorFactory  $pullRequestCreatorFactory
     * @param PullRequestAssigneeFactory $pullRequestAssigneeFactory
     * @param GithubRepoFacade           $githubRepoFacade
     * @param GithubPullRequestFacade    $githubPullRequestFacade
     * @param GithubCommitFacade         $githubCommitFacade
     * @param GithubUserFacade           $githubUserFacade
     * @param EntityManager              $em
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        RepoFactory $repoFactory,
        PullRequestFactory $pullRequestFactory,
        CommitFactory $commitFactory,
        PullRequestCreatorFactory $pullRequestCreatorFactory,
        PullRequestAssigneeFactory $pullRequestAssigneeFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubPullRequestFacade $githubPullRequestFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em
    ) {
        $this->repoFactory                = $repoFactory;
        $this->pullRequestFactory         = $pullRequestFactory;
        $this->commitFactory              = $commitFactory;
        $this->pullRequestCreatorFactory  = $pullRequestCreatorFactory;
        $this->pullRequestAssigneeFactory = $pullRequestAssigneeFactory;
        $this->githubRepoFacade           = $githubRepoFacade;
        $this->githubPullRequestFacade    = $githubPullRequestFacade;
        $this->githubCommitFacade         = $githubCommitFacade;
        $this->githubUserFacade           = $githubUserFacade;
        $this->em                         = $em;
    }

    /**
     * @param PullRequestPayload $pullRequestPayload
     *
     * @return bool
     */
    public function process(PullRequestPayload $pullRequestPayload)
    {
        $repoValueObject = $this->repoFactory->create($pullRequestPayload);
        $githubRepo      = $this->githubRepoFacade->getOrCreate($repoValueObject);

        $pullRequestValueObject = $this->pullRequestFactory->create($pullRequestPayload);
        $githubPullRequest      = $this->githubPullRequestFacade->getOrCreate($githubRepo, $pullRequestValueObject);

        $commitValueObject = $this->commitFactory->create($pullRequestPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $pullRequestCreatorValueObject = $this->pullRequestCreatorFactory->create($pullRequestPayload);
        $githubPullRequestCreator      = $this->githubUserFacade->getOrCreate($pullRequestCreatorValueObject);

        $githubPullRequest->setCreatedBy($githubPullRequestCreator);

        if (null !== $pullRequestPayload->getPullRequestAssigneeDetails()) {
            $pullRequestAssigneeValueObject = $this->pullRequestAssigneeFactory->create($pullRequestPayload);
            $githubPullRequestAssignee      = $this->githubUserFacade->getOrCreate($pullRequestAssigneeValueObject);

            $githubPullRequest->setAssignedTo($githubPullRequestAssignee);
        }

        $githubPullRequest->setLastCommit($githubCommit);

        $this->em->persist($githubPullRequest);
        $this->em->persist($githubCommit);
        $this->em->flush();

        return true;
    }
}
