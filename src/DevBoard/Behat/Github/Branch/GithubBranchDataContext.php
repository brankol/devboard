<?php
namespace DevBoard\Behat\Github\Branch;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use Resources\Behat\DefaultContext;

/**
 * Class GithubBranchDataContext.
 */
class GithubBranchDataContext extends DefaultContext
{
    use DataTrait;
    use GithubBranchValidationTrait;
    use RepoDataTrait;

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
        $branch = $this->getGithubBranchRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $branchName
            );

        if (!$branch) {
            throw new \Exception('Cant find github branch with name:'.$branchName.' for repo '.$githubRepoFullName);
        }
    }

    /**
     * @Then there should be no github branch :branchName for :githubRepoFullName in system
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function thereShouldBeNoGithubBranchForInSystem($branchName, $githubRepoFullName)
    {
        $branch = $this->getGithubBranchRepository()
            ->findOneByName(
                $this->getGithubRepoByFullName($githubRepoFullName),
                $branchName
            );

        if ($branch) {
            throw new \Exception('We found github branch with name:'.$branchName.' for repo '.$githubRepoFullName);
        }
    }
}
