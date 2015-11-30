<?php
namespace DevBoard\Github\ExternalService\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class GithubExternalServiceRepository.
 */
class GithubExternalServiceRepository extends EntityRepository
{
    /**
     * @param $context
     *
     * @return mixed
     */
    public function findOneByContext($context)
    {
        return parent::findOneByContext($context);
    }
}
