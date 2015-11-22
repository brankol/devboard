<?php
namespace DevBoard\Github\Commit;

use DevBoard\Github\Commit\Entity\GithubCommitFactory;
use DevBoard\Github\Commit\Entity\GithubCommitRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubCommitFacade.
 */
class GithubCommitFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubCommitFacade constructor.
     *
     * @param GithubCommitRepository $repository
     * @param GithubCommitFactory    $factory
     * @param EntityManager          $em
     */
    public function __construct(
        GithubCommitRepository $repository,
        GithubCommitFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Commit     $commitValueObject
     *
     * @return mixed
     */
    public function get(GithubRepo $githubRepo, Commit $commitValueObject)
    {
        return $this->repository->findOneBySha($githubRepo, $commitValueObject->getSha());
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Commit     $commitValueObject
     *
     * @return Entity\GithubCommit
     */
    public function create(GithubRepo $githubRepo, Commit $commitValueObject)
    {
        $entity = $this->factory->createFromValueObject($githubRepo, $commitValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Commit     $commitValueObject
     *
     * @return Entity\GithubCommit|mixed
     */
    public function getOrCreate(GithubRepo $githubRepo, Commit $commitValueObject)
    {
        $entity = $this->get($githubRepo, $commitValueObject);

        if (!$entity) {
            $entity = $this->create($githubRepo, $commitValueObject);
        }

        return $entity;
    }
}
