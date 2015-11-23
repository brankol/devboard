<?php
namespace DevBoard\Behat\Github\Repo;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Exception;
use Resources\Behat\DomainContext;

/**
 * Class GithubRepoContext.
 */
class GithubRepoContext extends DomainContext
{
    use DataTrait;
    use GithubRepoValidationTrait;

    private $service;

    private $error;

    /**
     * @Given I am fetching remote repo data from Github
     */
    public function iAmFetchingRemoteRepoDataFromGithub()
    {
        $this->setupGithubApiRepoService();
    }

    /**
     * @Given I am adding new github repo
     */
    public function iAmAddingNewGithubRepo()
    {
        $this->target = new GithubRepo();
    }

    /**
     * @When I look for details on :fullName
     *
     * @param $fullName
     */
    public function iLookForDetailsOn($fullName)
    {
        $this->fetchRemoteRepoDetailsFor($fullName);
    }

    /**
     * @When I fill in details for :fullName github repo
     *
     * @param $fullName
     */
    public function iFillInDetailsForGithubRepo($fullName)
    {
        $this->target = $this->fillRepoWithDetails($this->target, $fullName);
    }

    /**
     * @When I create :fullName github repo
     *
     * @param string $fullName
     */
    public function iCreateGithubRepo($fullName)
    {
        $service = $this->getService('github.repo.service');

        try {
            $this->target = $service->create($fullName, $this->getCurrentUser());
        } catch (Exception $exception) {
            $this->error = $exception;
        }
    }

    /**
     * @Then I will get repo details
     */
    public function iWillGetRepoDetails()
    {
        if (null !== $this->error) {
            throw new Exception('No error was expected!');
        }
        if (null === $this->target) {
            throw new Exception('Some remote data was expected but none found');
        }
    }

    /**
     * @Then I will get an error that repo doesnt exist
     */
    public function iWillGetAnErrorThatRepoDoesntExist()
    {
        if (null === $this->error) {
            throw new Exception('An error was expected but none found');
        }

        if ('Github\Exception\RuntimeException' !== get_class($this->error)) {
            throw new Exception('Expected Github\Exception\RuntimeException error');
        }

        if ('Not Found' !== $this->error->getMessage()) {
            throw new Exception('Expected exception with "Not Found" message.');
        }
    }

    private function setupGithubApiRepoService()
    {
        $this->service = $this->getService('null_dev_github_api.repo.service');
    }

    /**
     * @param $fullName
     */
    private function fetchRemoteRepoDetailsFor($fullName)
    {
        $githubRepo = $this->createRepoObjectFromFullName($fullName);

        try {
            $this->target = $this->service->fetch($githubRepo, $this->getCurrentUser());
        } catch (Exception $exception) {
            $this->error = $exception;
        }
    }
}
