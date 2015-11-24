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

    public function getBranchIdsFromRepoIds($repoIds)
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b.id')
            ->where('b.repo IN (:repoIds)')
            ->setParameter('repoIds', $repoIds);

        $rawResult = $queryBuilder->getQuery()->getArrayResult();

        $results = [];

        foreach ($rawResult as $result) {
            $results[] = $result['id'];
        }

        return $results;
    }

    public function getBranchesFromRepoIds($repoIds)
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->where('b.repo IN (:repoIds)')
            ->setParameter('repoIds', $repoIds)
            ->orderBy('b.updatedAt', 'DESC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
