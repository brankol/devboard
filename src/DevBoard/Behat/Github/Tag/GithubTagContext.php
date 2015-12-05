<?php
namespace DevBoard\Behat\Github\Tag;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Tag\Entity\GithubTag;
use Exception;
use Resources\Behat\DomainContext;

/**
 * Class GithubTagContext.
 */
class GithubTagContext extends DomainContext
{
    use DataTrait;
    use GithubTagValidationTrait;
    use RepoDataTrait;

    private $error;

    /**
     * @Given I am fetching remote tag data from Github
     */
    public function iAmFetchingRemoteTagDataFromGithub()
    {
        $this->setupGithubApiTagService();
    }

    /**
     * @Given I am adding new github tag
     */
    public function iAmAddingNewGithubTag()
    {
        $this->target = new GithubTag();
    }

    /**
     * @When I look for details :tagName on :githubRepoFullName github repo
     *
     * @param $tagName
     * @param $githubRepoFullName
     */
    public function iLookForDetailsOnGithubRepo($tagName, $githubRepoFullName)
    {
        $service = $this->getService('null_dev_github_api.tag.service');

        $githubRepo = $this->createRepoObjectFromFullName($githubRepoFullName);
        $githubTag  = $this->createTagObjectFromTagName($tagName);

        $this->target = $service->fetch($githubRepo, $githubTag, $this->getCurrentUser());
    }

    /**
     * @When I fill in details for :tagName github tag for :githubRepoFullName github repo
     *
     * @param $tagName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function iFillInDetailsForGithubTagForGithubRepo($tagName, $githubRepoFullName)
    {
        $this->target->setName($tagName)
            ->setRepo($this->getGithubRepoByFullName($githubRepoFullName));
    }

    /**
     * @Then I will get tag details
     */
    public function iWillGetTagDetails()
    {
        if (null !== $this->error) {
            throw new Exception('No error was expected!');
        }
        if (null === $this->target) {
            throw new Exception('Some remote data was expected but none found');
        }
    }

    private function setupGithubApiTagService()
    {
        $this->service = $this->getService('null_dev_github_api.tag.service');
    }
}
