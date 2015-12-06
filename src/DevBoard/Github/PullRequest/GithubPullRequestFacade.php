<?php
namespace DevBoard\Github\PullRequest;

use DevBoard\Github\PullRequest\Entity\GithubPullRequestFactory;
use DevBoard\Github\PullRequest\Entity\GithubPullRequestRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubPullRequestFacade.
 */
class GithubPullRequestFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubPullRequestFacade constructor.
     *
     * @param GithubPullRequestRepository $repository
     * @param GithubPullRequestFactory    $factory
     * @param EntityManager               $em
     */
    public function __construct(
        GithubPullRequestRepository $repository,
        GithubPullRequestFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubRepo  $githubRepo
     * @param PullRequest $pullRequestValueObject
     *
     * @return mixed
     */
    public function get(GithubRepo $githubRepo, PullRequest $pullRequestValueObject)
    {
        return $this->repository->findOneByTitle($githubRepo, $pullRequestValueObject->getTitle());
    }

    /**
     * @param GithubRepo  $githubRepo
     * @param PullRequest $pullRequestValueObject
     *
     * @return Entity\GithubPullRequest
     */
    public function create(GithubRepo $githubRepo, PullRequest $pullRequestValueObject)
    {
        $entity = $this->factory->createFromValueObject($githubRepo, $pullRequestValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param GithubRepo  $githubRepo
     * @param PullRequest $pullRequestValueObject
     *
     * @return Entity\GithubPullRequest|mixed
     */
    public function getOrCreate(GithubRepo $githubRepo, PullRequest $pullRequestValueObject)
    {
        $entity = $this->get($githubRepo, $pullRequestValueObject);

        if (!$entity) {
            $entity = $this->create($githubRepo, $pullRequestValueObject);
        }

        return $entity;
    }
}
