<?php
namespace DevBoard\Github\Branch\Entity;

use DevBoard\Github\Branch\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;

/**
 * Class GithubBranchFactory.
 */
class GithubBranchFactory
{
    private $mapper;

    /**
     * GithubBranchFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Branch     $branchValueObject
     *
     * @return GithubBranch
     */
    public function createFromValueObject(GithubRepo $githubRepo, Branch $branchValueObject)
    {
        $githubBranch = new GithubBranch();
        $githubBranch->setRepo($githubRepo);

        $this->mapper->map($branchValueObject, $githubBranch);

        return $githubBranch;
    }
}
