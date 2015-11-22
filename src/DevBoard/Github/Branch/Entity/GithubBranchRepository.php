<?php
namespace DevBoard\Github\Branch\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\EntityRepository;

/**
 * Class GithubBranchRepository.
 */
class GithubBranchRepository extends EntityRepository
{
    /**
     * @param GithubRepo $githubRepo
     * @param            $branchName
     *
     * @return mixed
     *
     * @internal param GithubRepo $repo
     * @codeCoverageIgnore
     */
    public function findOneByName(GithubRepo $githubRepo, $branchName)
    {
        return $this->findOneBy(
            [
                'name' => $branchName,
                'repo' => $githubRepo,
            ]
        );
    }
}
