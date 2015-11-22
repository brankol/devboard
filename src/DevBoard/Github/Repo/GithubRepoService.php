<?php
namespace DevBoard\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\Entity\GithubRepoFactory;
use DevBoard\Github\Repo\Mapper\RemoteToEntityMapper;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Repo\RemoteGithubRepoService;
use NullDev\UserBundle\Entity\User;

/**
 * Class GithubRepoService.
 */
class GithubRepoService
{
    private $repoFactory;
    private $remoteService;
    private $mapper;
    private $em;

    /**
     * @param GithubRepoFactory       $repoFactory
     * @param RemoteGithubRepoService $remoteService
     * @param RemoteToEntityMapper    $mapper
     * @param EntityManager           $em
     */
    public function __construct(
        GithubRepoFactory $repoFactory,
        RemoteGithubRepoService $remoteService,
        RemoteToEntityMapper $mapper,
        EntityManager $em
    ) {
        $this->repoFactory   = $repoFactory;
        $this->remoteService = $remoteService;
        $this->mapper        = $mapper;
        $this->em            = $em;
    }

    /**
     * @param string $githubRepoFullName
     * @param User   $user
     *
     * @return GithubRepo
     */
    public function create($githubRepoFullName, User $user)
    {
        $githubRepo = $this->repoFactory->create($githubRepoFullName);

        $githubRepoData = $this->remoteService->fetch($githubRepo, $user);
        $this->mapper->map($githubRepoData, $githubRepo);

        $this->em->persist($githubRepo);
        $this->em->flush();

        return $githubRepo;
    }
}
