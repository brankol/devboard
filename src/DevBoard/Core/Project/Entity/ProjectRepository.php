<?php
namespace DevBoard\Core\Project\Entity;

use Doctrine\ORM\EntityRepository;
use NullDev\UserBundle\Entity\User;

/**
 * Class ProjectRepository.
 */
class ProjectRepository extends EntityRepository
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function getUserProjects(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->innerJoin('p.users', 'u', 'WITH', 'u.id = :user_id')
            ->setParameter('user_id', $user->getId());

        return $queryBuilder->getQuery()->getResult();
    }

    public function getUserProjectIds(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select('p.id')
            ->where('p.user = :user_id')
            ->setParameter('user_id', $user->getId());

        $rawResult = $queryBuilder->getQuery()->getArrayResult();

        $results = [];

        foreach ($rawResult as $result) {
            $results[] = $result['id'];
        }

        return $results;
    }
}
