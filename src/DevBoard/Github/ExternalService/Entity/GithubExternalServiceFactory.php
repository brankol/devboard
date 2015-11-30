<?php
namespace DevBoard\Github\ExternalService\Entity;

/**
 * Class GithubExternalServiceFactory.
 */
class GithubExternalServiceFactory
{
    /**
     * @param $context
     *
     * @return GithubExternalService
     */
    public function createFromContext($context)
    {
        $externalService = new GithubExternalService();

        $externalService
            ->setName($context)
            ->setContext($context);

        return $externalService;
    }
}
