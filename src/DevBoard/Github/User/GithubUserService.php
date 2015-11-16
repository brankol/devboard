<?php
namespace DevBoard\Github\User;

use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\Entity\GithubUserFactory;
use DevBoard\Github\User\Mapper\RemoteToEntityMapper;
use Doctrine\ORM\EntityManager;
use Exception;
use NullDev\GithubApi\User\RemoteGithubUserService;
use NullDev\UserBundle\Entity\User;

/**
 * Class GithubUserService.
 */
class GithubUserService
{
    private $userFactory;
    private $remoteService;
    private $mapper;
    private $em;

    /**
     * @param GithubUserFactory       $userFactory
     * @param RemoteGithubUserService $remoteService
     * @param RemoteToEntityMapper    $mapper
     * @param EntityManager           $em
     */
    public function __construct(
        GithubUserFactory $userFactory,
        RemoteGithubUserService $remoteService,
        RemoteToEntityMapper $mapper,
        EntityManager $em
    ) {
        $this->userFactory   = $userFactory;
        $this->remoteService = $remoteService;
        $this->mapper        = $mapper;
        $this->em            = $em;
    }

    /**
     * @param string $githubUsername
     * @param User   $user
     *
     * @return GithubUser
     */
    public function create($githubUsername, User $user)
    {
        $githubUser = $this->userFactory->create($githubUsername);

        $githubUserData = $this->remoteService->fetch($githubUser, $user);
        $this->mapper->map($githubUserData, $githubUser);

        $this->em->persist($githubUser);
        $this->em->flush();

        return $githubUser;
    }
}
