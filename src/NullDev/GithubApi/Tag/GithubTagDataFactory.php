<?php
namespace NullDev\GithubApi\Tag;

/**
 * Class GithubTagDataFactory.
 */
class GithubTagDataFactory
{
    /**
     * @param array $inputData
     *
     * @return GithubTagData
     */
    public function create(array $inputData)
    {
        $name   = $inputData['name'];
        $commit = $inputData['commit'];

        return new GithubTagData(
            $name,
            $commit
        );
    }
}
