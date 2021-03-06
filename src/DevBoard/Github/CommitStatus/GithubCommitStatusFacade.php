<?php
namespace DevBoard\Github\CommitStatus;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatus;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatusFactory;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatusRepository;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubCommitStatusFacade.
 */
class GithubCommitStatusFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubCommitFacade constructor.
     *
     * @param GithubCommitStatusRepository $repository
     * @param GithubCommitStatusFactory    $factory
     * @param EntityManager                $em
     */
    public function __construct(
        GithubCommitStatusRepository $repository,
        GithubCommitStatusFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubCommit          $githubCommit
     * @param GithubExternalService $githubExternalService
     *
     * @return GithubCommitStatus
     */
    public function get(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        return $this->repository->findOneByRepoCommitAndExternalService(
            $githubCommit,
            $githubExternalService
        );
    }

    /**
     * @param GithubCommit          $githubCommit
     * @param GithubExternalService $githubExternalService
     *
     * @return GithubCommitStatus
     */
    public function create(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        $status = $this->factory->create($githubCommit, $githubExternalService);

        $this->em->persist($status);
        $this->em->flush();

        return $status;
    }

    /**
     * @param GithubCommit          $githubCommit
     * @param GithubExternalService $githubExternalService
     *
     * @return GithubCommitStatus
     */
    public function getOrCreate(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        $status = $this->get($githubCommit, $githubExternalService);

        if (!$status) {
            $status = $this->create($githubCommit, $githubExternalService);
        }

        return $status;
    }
}
