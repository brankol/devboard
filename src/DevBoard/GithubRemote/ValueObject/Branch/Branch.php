<?php
namespace DevBoard\GithubRemote\ValueObject\Branch;

use NullDev\GithubApi\Branch\GithubBranchDataInterface;

/**
 * Class Branch.
 */
class Branch implements GithubBranchDataInterface
{
    private $name;

    /**
     * Branch constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
