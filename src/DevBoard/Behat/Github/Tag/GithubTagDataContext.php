<?php
namespace DevBoard\Behat\Github\Tag;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use Resources\Behat\DefaultContext;

/**
 * Class GithubTagDataContext.
 */
class GithubTagDataContext extends DefaultContext
{
    use DataTrait;
    use GithubTagValidationTrait;
    use RepoDataTrait;

    /**
     * @Then there should be github tag :tagName for :githubRepoFullName in system
     *
     * @param $tagName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubTagForInSystem($tagName, $githubRepoFullName)
    {
        $tag = $this->getGithubTagRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $tagName
            );

        if (!$tag) {
            throw new \Exception('Cant find github tag with name:'.$tagName.' for repo '.$githubRepoFullName);
        }
    }

    /**
     * @Then there should be no github tag :tagName for :githubRepoFullName in system
     *
     * @param $tagName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeNoGithubTagForInSystem($tagName, $githubRepoFullName)
    {
        $tag = $this->getGithubTagRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $tagName
            );

        if ($tag) {
            throw new \Exception('We found github tag with name:'.$tagName.' for repo '.$githubRepoFullName);
        }
    }
}
