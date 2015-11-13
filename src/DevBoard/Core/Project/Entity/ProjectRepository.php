<?php
namespace DevBoard\Core\Project\Entity;

use Doctrine\ORM\EntityRepository;

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
}
