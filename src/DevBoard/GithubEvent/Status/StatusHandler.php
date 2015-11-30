<?php
namespace DevBoard\GithubEvent\Status;

use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\CommitStatus\GithubCommitStatusFacade;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use DevBoard\Github\ExternalService\GithubExternalServiceFacade;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubEvent\Status\Data\BranchFactory;
use DevBoard\GithubEvent\Status\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Status\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Status\Data\CommitFactory;
use DevBoard\GithubEvent\Status\Data\CommitStatusFactory;
use DevBoard\GithubEvent\Status\Data\ExternalServiceFactory;
use DevBoard\GithubEvent\Status\Data\RepoFactory;
use Doctrine\ORM\EntityManager;

/**
 * Class StatusHandler.
 */
class StatusHandler
{
    private $repoFactory;
    private $commitFactory;
    private $externalServiceFactory;
    private $commitStatusFactory;
    private $githubRepoFacade;
    private $githubCommitFacade;
    private $githubExternalServiceFacade;
    private $githubCommitStatusFacade;
    private $em;

    /**
     * @param RepoFactory                 $repoFactory
     * @param CommitFactory               $commitFactory
     * @param ExternalServiceFactory      $externalServiceFactory
     * @param CommitStatusFactory         $commitStatusFactory
     * @param GithubRepoFacade            $githubRepoFacade
     * @param GithubCommitFacade          $githubCommitFacade
     * @param GithubExternalServiceFacade $githubExternalServiceFacade
     * @param GithubCommitStatusFacade    $githubCommitStatusFacade
     * @param EntityManager               $em
     */
    public function __construct(
        RepoFactory $repoFactory,
        CommitFactory $commitFactory,
        ExternalServiceFactory $externalServiceFactory,
        CommitStatusFactory $commitStatusFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubExternalServiceFacade $githubExternalServiceFacade,
        GithubCommitStatusFacade $githubCommitStatusFacade,
        EntityManager $em
    ) {
        $this->repoFactory                 = $repoFactory;
        $this->commitFactory               = $commitFactory;
        $this->externalServiceFactory      = $externalServiceFactory;
        $this->commitStatusFactory         = $commitStatusFactory;
        $this->githubRepoFacade            = $githubRepoFacade;
        $this->githubCommitFacade          = $githubCommitFacade;
        $this->githubExternalServiceFacade = $githubExternalServiceFacade;
        $this->githubCommitStatusFacade    = $githubCommitStatusFacade;
        $this->em                          = $em;
    }

    /**
     * @param StatusPayload $statusPayload
     *
     * @return bool
     */
    public function process(StatusPayload $statusPayload)
    {
        $repoValueObject = $this->repoFactory->create($statusPayload);
        $githubRepo      = $this->githubRepoFacade->getOrCreate($repoValueObject);

        $commitValueObject = $this->commitFactory->create($statusPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $externalServiceValueObject = $this->externalServiceFactory->create($statusPayload);
        $githubExternalService      = $this->githubExternalServiceFacade
            ->getOrCreate($externalServiceValueObject->getContext());

        $commitStatusValueObject = $this->commitStatusFactory->create($statusPayload);
        $githubCommitStatus      = $this->githubCommitStatusFacade
            ->getOrCreate($githubCommit, $githubExternalService, $commitStatusValueObject);

        $githubCommitStatus->setState(GithubCommitStatusState::convert($statusPayload->getState()));

        $this->em->persist($githubCommitStatus);
        $this->em->flush();

        return true;
    }
}
