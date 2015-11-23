<?php
namespace DevBoard\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\Entity\GithubRepoRepository;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;

/**
 * Class GithubRepoFacade.
 */
class GithubRepoFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubRepoFacade constructor.
     *
     * @param GithubRepoRepository $repository
     * @param GithubRepoFactory    $factory
     * @param EntityManager        $em
     */
    public function __construct(
        GithubRepoRepository $repository,
        GithubRepoFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param Repo|GithubRepoDataInterface $repoValueObject
     *
     * @return mixed
     */
    public function get(GithubRepoDataInterface $repoValueObject)
    {
        return $this->repository->findOneByFullName($repoValueObject->getFullName());
    }

    /**
     * @param Repo|GithubRepoDataInterface $repoValueObject
     *
     * @return Entity\GithubRepo
     */
    public function create(GithubRepoDataInterface $repoValueObject)
    {
        $entity = $this->factory->createFromValueObject($repoValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param Repo|GithubRepoDataInterface $repoValueObject
     *
     * @return Entity\GithubRepo|mixed
     */
    public function getOrCreate(GithubRepoDataInterface $repoValueObject)
    {
        $entity = $this->get($repoValueObject);

        if (!$entity) {
            $entity = $this->create($repoValueObject);
        }

        return $entity;
    }
}
