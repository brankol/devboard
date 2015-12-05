<?php
namespace DevBoard\GithubRemote\ValueObject\Tag;

use NullDev\GithubApi\Tag\GithubTagDataInterface;

/**
 * Class Tag.
 */
class Tag implements GithubTagDataInterface
{
    private $name;

    /**
     * Tag constructor.
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
