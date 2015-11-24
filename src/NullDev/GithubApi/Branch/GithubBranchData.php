<?php
namespace NullDev\GithubApi\Branch;

/**
 * Class GithubBranchData.
 */
class GithubBranchData implements GithubBranchDataInterface
{
    private $name;
    private $commitData;

    /**
     * GithubBranchData constructor.
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
