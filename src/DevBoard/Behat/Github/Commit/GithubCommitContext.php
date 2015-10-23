<?php
namespace DevBoard\Behat\Github\Commit;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use DevBoard\Behat\Github\Branch\DataTrait as BranchDataTrait;
use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Commit\GithubCommit;
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
     * @Given I am adding new github commit to :branchName branch of :githubRepoFullName repo
     *
     * @param $branchName
     * @param $githubRepoFullName
     *
     * @throws \Exception
     */
    public function iAmAddingNewGithubCommitToBranchOfRepo($branchName, $githubRepoFullName)
    {
        $this->branch = $this->getGithubBranchByName($branchName);
        $this->repo   = $this->getGithubRepoByFullName($githubRepoFullName);
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

    /**
     * @Then there should be github commit with message :message in system
     *
     * @param $message
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubCommitWithMessageInSystem($message)
    {
        $this->getGithubCommitByMessage($message);
    }
}
