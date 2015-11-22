<?php
namespace DevBoard\Github\User\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class GithubUserRepository.
 */
class GithubUserRepository extends EntityRepository
{
    /**
     * @param $username
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function findOneByUsername($username)
    {
        return parent::findOneByUsername($username);
    }
}
