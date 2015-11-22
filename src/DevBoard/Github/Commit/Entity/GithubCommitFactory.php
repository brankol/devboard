<?php
namespace DevBoard\Github\Commit\Entity;

use DevBoard\Github\Commit\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;

/**
 * Class GithubCommitFactory.
 */
class GithubCommitFactory
{
    private $mapper;

    /**
     * GithubCommitFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Commit     $commitValueObject
     *
     * @return GithubCommit
     */
    public function createFromValueObject(GithubRepo $githubRepo, Commit $commitValueObject)
    {
        $githubCommit = new GithubCommit();
        $githubCommit->setGithubRepo($githubRepo);

        $this->mapper->map($commitValueObject, $githubCommit);

        return $githubCommit;
    }
}
