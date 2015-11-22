<?php
namespace DevBoard\Behat\Github\Commit;

use DevBoard\Behat\Github\Branch\DataTrait as BranchDataTrait;
use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Commit\Entity\GithubCommit;
use Resources\Behat\DomainContext;

/**
 * Class GithubCommitContext.
 */
class GithubCommitContext extends DomainContext
{
    use DataTrait;
    use GithubCommitValidationTrait;
    use RepoDataTrait;
    use BranchDataTrait;

    /**
     * @var \DevBoard\Github\Repo\Entity\GithubRepo
     */
    private $repo;

    /**
     * @var \DevBoard\Github\Branch\Entity\GithubBranch
     */
    private $branch;

    /**
     * @Given I am adding new github commit to :branchName branch of :githubRepoFullName repo
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function iAmAddingNewGithubCommitToBranchOfRepo($branchName, $githubRepoFullName)
    {
        $this->repo   = $this->getGithubRepoByFullName($githubRepoFullName);
        $this->branch = $this->getGithubBranchByName($branchName);
        $this->target = new GithubCommit();
    }

    /**
     * @When I fill in details for :message github commit
     *
     * @param $message
     */
    public function iFillInDetailsForGithubCommit($message)
    {
        $this->target->setSha('sha1')
            ->setMessage($message)
            ->setGithubRepo($this->repo)
            ->setAuthorDate(new \DateTime('2015-01-05 06:07:08'))
            ->setCommitterDate(new \DateTime('2015-01-05 06:07:08'));

        $this->branch->setLastCommit($this->target);
        $this->validateAndSave($this->branch);
    }
}
