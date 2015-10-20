<?php
namespace DevBoard\Github\Repo;

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
}
