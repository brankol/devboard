<?php
namespace DevBoard\Behat\Github\Branch;

use Behat\Gherkin\Node\TableNode;
use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Branch\GithubBranch;
use Resources\Behat\DefaultContext;

/**
 * Class FixtureContext.
 */
class FixtureContext extends DefaultContext
{
    use DataTrait;
    use RepoDataTrait;

    /**
     * @Given there is :branchName branch on :githubRepoFullName github repo
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereIsBranchOnGithubRepo($branchName, $githubRepoFullName)
    {
        $branch = new GithubBranch();

        $branch->setName($branchName)
            ->setRepo($this->getGithubRepoByFullName($githubRepoFullName));

        $this->save($branch);
    }
}
