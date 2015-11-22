<?php
namespace DevBoard\Github\User;

use DevBoard\Github\User\Entity\GithubUserFactory;
use DevBoard\Github\User\Entity\GithubUserRepository;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class GithubUserFacade.
 */
class GithubUserFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubUserFacade constructor.
     *
     * @param GithubUserRepository $repository
     * @param GithubUserFactory    $factory
     * @param EntityManager        $em
     */
    public function __construct(
        GithubUserRepository $repository,
        GithubUserFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubUserDataInterface $userValueObject
     *
     * @return mixed
     */
    public function get(GithubUserDataInterface $userValueObject)
    {
        return $this->repository->findOneByUsername($userValueObject->getUsername());
    }

    /**
     * @param GithubUserDataInterface $userValueObject
     *
     * @return Entity\GithubUser
     */
    public function create(GithubUserDataInterface $userValueObject)
    {
        $entity = $this->factory->createFromValueObject($userValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param GithubUserDataInterface $userValueObject
     *
     * @return Entity\GithubUser|mixed
     */
    public function getOrCreate(GithubUserDataInterface $userValueObject)
    {
        $entity = $this->get($userValueObject);

        if (!$entity) {
            $entity = $this->create($userValueObject);
        }

        return $entity;
    }
}
