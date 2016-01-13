<?php
namespace DevBoard\Github\ExternalService\Entity;

use Resources\Entity\BaseEntity;

/**
 * Class GithubExternalService.
 */
class GithubExternalService extends BaseEntity
{
    /** @var string */
    private $name;

    /** @var string */
    private $context;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     *
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getLiveInfo()
    {
        return [
            'name'    => $this->getName(),
            'context' => $this->getContext(),
        ];
    }
}
