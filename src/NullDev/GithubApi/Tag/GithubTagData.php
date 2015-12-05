<?php
namespace NullDev\GithubApi\Tag;

/**
 * Class GithubTagData.
 */
class GithubTagData implements GithubTagDataInterface
{
    private $name;
    private $commitData;

    /**
     * GithubTagData constructor.
     *
     * @param string $name
     * @param array  $commitData
     */
    public function __construct($name, array $commitData)
    {
        $this->name       = $name;
        $this->commitData = $commitData;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getCommitData()
    {
        return $this->commitData;
    }
}
