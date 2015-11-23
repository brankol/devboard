<?php
namespace DevBoard\Behat\Github\Branch;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Branch\Entity\GithubBranch;
use Resources\Behat\DomainContext;

/**
 * Class GithubBranchContext.
 */
class GithubBranchContext extends DomainContext
{
    use DataTrait;
    use GithubBranchValidationTrait;
    use RepoDataTrait;

    private $error;

    /**
     * @Given I am fetching remote branch data from Github
     */
    public function iAmFetchingRemoteBranchDataFromGithub()
    {
        $this->setupGithubApiBranchService();
    }

    /**
     * @Given I am adding new github branch
     */
    public function iAmAddingNewGithubBranch()
    {
        $this->target = new GithubBranch();
    }

    /**
     * @When I look for details :branchName on :githubRepoFullName github repo
     *
     * @param $branchName
     * @param $githubRepoFullName
     */
    public function iLookForDetailsOnGithubRepo($branchName, $githubRepoFullName)
    {
        $service = $this->getService('null_dev_github_api.branch.service');

        $githubRepo   = $this->createRepoObjectFromFullName($githubRepoFullName);
        $githubBranch = $this->createBranchObjectFromBranchName($branchName);

        $this->target = $service->fetch($githubRepo, $githubBranch, $this->getCurrentUser());
    }

    /**
     * @When I fill in details for :branchName github branch for :githubRepoFullName github repo
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function iFillInDetailsForGithubBranchForGithubRepo($branchName, $githubRepoFullName)
    {
        $this->target->setName($branchName)
            ->setRepo($this->getGithubRepoByFullName($githubRepoFullName));
    }

    /**
     * @Then I will get branch details
     */
    public function iWillGetBranchDetails()
    {
        if (null !== $this->error) {
            throw new Exception('No error was expected!');
        }
        if (null === $this->target) {
            throw new Exception('Some remote data was expected but none found');
        }
    }

    private function setupGithubApiBranchService()
    {
        $this->service = $this->getService('null_dev_github_api.branch.service');
    }
}
