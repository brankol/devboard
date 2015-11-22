<?php
namespace DevBoard\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\Entity\GithubRepoRepository;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use Doctrine\ORM\EntityManager;

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
     * @param Repo $repoValueObject
     *
     * @return mixed
     */
    public function get(Repo $repoValueObject)
    {
        return $this->repository->findOneByFullName($repoValueObject->getFullName());
    }

    /**
     * @param Repo $repoValueObject
     *
     * @return Entity\GithubRepo
     */
    public function create(Repo $repoValueObject)
    {
        $entity = $this->factory->createFromValueObject($repoValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param Repo $repoValueObject
     *
     * @return Entity\GithubRepo|mixed
     */
    public function getOrCreate(Repo $repoValueObject)
    {
        $entity = $this->get($repoValueObject);

        if (!$entity) {
            $entity = $this->create($repoValueObject);
        }

        return $entity;
    }
}
