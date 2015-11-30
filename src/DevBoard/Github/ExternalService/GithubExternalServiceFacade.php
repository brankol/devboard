<?php
namespace DevBoard\Github\ExternalService;

use DevBoard\Github\ExternalService\Entity\GithubExternalServiceFactory;
use DevBoard\Github\ExternalService\Entity\GithubExternalServiceRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class GithubExternalServiceFacade.
 */
class GithubExternalServiceFacade
{
    private $repository;
    private $factory;
    private $em;

    /**
     * GithubExternalServiceFacade constructor.
     *
     * @param $repository
     * @param $factory
     * @param $em
     */
    public function __construct(
        GithubExternalServiceRepository $repository,
        GithubExternalServiceFactory $factory,
        EntityManager $em
    ) {
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->em         = $em;
    }

    /**
     * @param $context
     *
     * @return mixed
     */
    public function get($context)
    {
        return $this->repository->findOneByContext($context);
    }

    /**
     * @param $context
     *
     * @return Entity\GithubExternalService
     */
    public function create($context)
    {
        $externalService = $this->factory->createFromContext($context);

        $this->em->persist($externalService);
        $this->em->flush();

        return $externalService;
    }

    /**
     * @param $context
     *
     * @return Entity\GithubExternalService|mixed
     */
    public function getOrCreate($context)
    {
        $externalService = $this->get($context);

        if (!$externalService) {
            $externalService = $this->create($context);
        }

        return $externalService;
    }
}
