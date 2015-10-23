<?php
namespace DevBoard\Behat\NullDev\User;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @return mixed
     */
    private function getUserRepository()
    {
        return $this->getEntityManager()->getRepository('NullDevUserBundle:User');
    }
}
