<?php
namespace DevBoard\Github\Repo\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class GithubRepoRepository.
 */
class GithubRepoRepository extends EntityRepository
{
    /**
     * @param $fullName
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function findOneByFullName($fullName)
    {
        return parent::findOneByFullName($fullName);
    }

    /**
     * @param $projectIds
     *
     * @return array
     */
    public function getRepoIdsFromProjectIds($projectIds)
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->join('r.projects', 'p')
            ->select('r.id')
            ->where('p.id IN (:projectIds)')
            ->setParameter('projectIds', $projectIds);

        $rawResult = $queryBuilder->getQuery()->getArrayResult();

        $results = [];

        foreach ($rawResult as $result) {
            $results[] = $result['id'];
        }

        return $results;
    }
}
