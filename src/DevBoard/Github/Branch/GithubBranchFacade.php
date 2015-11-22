<?php
namespace DevBoard\Github\Branch;

use DevBoard\Github\Branch\Entity\GithubBranchFactory;
use DevBoard\Github\Branch\Entity\GithubBranchRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubBranchFacade.
 */
class GithubBranchFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubBranchFacade constructor.
     *
     * @param GithubBranchRepository $repository
     * @param GithubBranchFactory    $factory
     * @param EntityManager          $em
     */
    public function __construct(
        GithubBranchRepository $repository,
        GithubBranchFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Branch     $branchValueObject
     *
     * @return mixed
     */
    public function get(GithubRepo $githubRepo, Branch $branchValueObject)
    {
        return $this->repository->findOneByName($githubRepo, $branchValueObject->getName());
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Branch     $branchValueObject
     *
     * @return Entity\GithubBranch
     */
    public function create(GithubRepo $githubRepo, Branch $branchValueObject)
    {
        $entity = $this->factory->createFromValueObject($githubRepo, $branchValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Branch     $branchValueObject
     *
     * @return Entity\GithubBranch|mixed
     */
    public function getOrCreate(GithubRepo $githubRepo, Branch $branchValueObject)
    {
        $entity = $this->get($githubRepo, $branchValueObject);

        if (!$entity) {
            $entity = $this->create($githubRepo, $branchValueObject);
        }

        return $entity;
    }
}
