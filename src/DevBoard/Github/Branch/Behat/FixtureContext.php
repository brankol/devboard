<?php
namespace DevBoard\Github\Branch\Behat;

use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\Branch\GithubBranch;
use DevBoard\Github\Repo\Behat\DataTrait as RepoDataTrait;
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
