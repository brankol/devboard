<?php
namespace DevBoard\Github\Tag;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Tag\Entity\GithubTagFactory;
use DevBoard\Github\Tag\Entity\GithubTagRepository;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubTagFacade.
 */
class GithubTagFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubTagFacade constructor.
     *
     * @param GithubTagRepository $repository
     * @param GithubTagFactory    $factory
     * @param EntityManager       $em
     */
    public function __construct(
        GithubTagRepository $repository,
        GithubTagFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Tag        $tagValueObject
     *
     * @return mixed
     */
    public function get(GithubRepo $githubRepo, Tag $tagValueObject)
    {
        return $this->repository->findOneByName($githubRepo, $tagValueObject->getName());
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Tag        $tagValueObject
     *
     * @return Entity\GithubTag
     */
    public function create(GithubRepo $githubRepo, Tag $tagValueObject)
    {
        $entity = $this->factory->createFromValueObject($githubRepo, $tagValueObject);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Tag        $tagValueObject
     *
     * @return Entity\GithubTag|mixed
     */
    public function getOrCreate(GithubRepo $githubRepo, Tag $tagValueObject)
    {
        $entity = $this->get($githubRepo, $tagValueObject);

        if (!$entity) {
            $entity = $this->create($githubRepo, $tagValueObject);
        }

        return $entity;
    }
}
