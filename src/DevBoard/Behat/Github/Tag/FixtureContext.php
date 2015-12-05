<?php
namespace DevBoard\Behat\Github\Tag;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Tag\Entity\GithubTag;
use Resources\Behat\DefaultContext;

/**
 * Class FixtureContext.
 */
class FixtureContext extends DefaultContext
{
    use DataTrait;
    use RepoDataTrait;

    /**
     * @Given there is :tagName tag on :githubRepoFullName github repo
     *
     * @param $tagName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereIsTagOnGithubRepo($tagName, $githubRepoFullName)
    {
        $tag = new GithubTag();

        $tag->setName($tagName)
            ->setRepo($this->getGithubRepoByFullName($githubRepoFullName));

        $this->save($tag);
    }
}
