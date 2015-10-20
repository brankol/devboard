<?php
namespace DevBoard\Github\Branch\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\Branch\GithubBranch;
use DevBoard\Github\Repo\Behat\DataTrait as RepoDataTrait;
use Resources\Behat\DomainContext;

/**
 * Class GithubBranchContext.
 */
class GithubBranchContext extends DomainContext
{
    use DataTrait;
    use GithubBranchValidationTrait;
    use RepoDataTrait;

    /**
     * @Given I am adding new github branch
     */
    public function iAmAddingNewGithubBranch()
    {
        $this->target = new GithubBranch();
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
     * @Then there should be github branch :branchName for :githubRepoFullName in system
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubBranchForInSystem($branchName, $githubRepoFullName)
    {
        $branch = $this->getGithubBranchRepository()->findOneBy(
            [
                'name' => $branchName,
                'repo' => $this->getGithubRepoByFullName($githubRepoFullName),
            ]
        );

        if (!$branch) {
            throw new \Exception('Cant find github branch with name:'.$branchName.' for repo '.$githubRepoFullName);
        }
    }
}
