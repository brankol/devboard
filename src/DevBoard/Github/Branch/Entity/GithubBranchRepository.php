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

    /**
     * @param $repoIds
     *
     * @return array
     */
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

    /**
     * @param $repoIds
     *
     * @return array
     */
    public function getBranchesFromRepoIds($repoIds)
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.lastCommit', 'c')
            ->where('b.repo IN (:repoIds)')
            ->setParameter('repoIds', $repoIds)
            ->orderBy('c.committerDate', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param $repoIds
     *
     * @return array
     */
    public function getLiveBranchesFromRepoIds($repoIds)
    {
        $timeLimit = new \DateTime();
        $timeLimit->modify('-60 min');

        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.lastCommit', 'c')
            ->where('b.repo IN (:repoIds)')
            ->andWhere('b.updatedAt > :timeLimit')
            ->setParameter('repoIds', $repoIds)
            ->setParameter('timeLimit', $timeLimit)
            ->orderBy('b.updatedAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}
