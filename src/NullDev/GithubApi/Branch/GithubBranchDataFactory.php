<?php
namespace NullDev\GithubApi\Branch;

/**
 * Class GithubBranchDataFactory.
 */
class GithubBranchDataFactory
{
    /**
     * @param array $inputData
     *
     * @return GithubBranchData
     */
    public function create(array $inputData)
    {
        $name   = $inputData['name'];
        $commit = $inputData['commit'];

        return new GithubBranchData(
            $name,
            $commit
        );
    }
}
