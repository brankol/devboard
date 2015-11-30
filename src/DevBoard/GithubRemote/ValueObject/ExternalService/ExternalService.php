<?php
namespace DevBoard\GithubRemote\ValueObject\ExternalService;

/**
 * Class ExternalService.
 */
class ExternalService
{
    private $context;

    /**
     * ExternalService constructor.
     *
     * @param $context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }
}
