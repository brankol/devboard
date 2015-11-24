<?php
namespace DevBoard\Behat\Github\Commit;

use DevBoard\Behat\Github\Branch\DataTrait as BranchDataTrait;
use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\Github\Commit\Entity\GithubCommit;
use Exception;
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

    private $error;

    /**
     * @Given I am fetching remote commit data from Github for :githubRepoFullName repo
     *
     * @param $githubRepoFullName
     *
     * @throws Exception
     */
    public function iAmFetchingRemoteCommitDataFromGithubForRepo($githubRepoFullName)
    {
        $this->setupGithubApiCommitService();
        $this->repo = $this->getGithubRepoByFullName($githubRepoFullName);
    }

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
        $this->branch = $this->getGithubBranchByName($this->repo, $branchName);
        $this->target = new GithubCommit();
    }

    /**
     * @Given I am adding new github commit for :githubRepoFullName
     *
     * @param $githubRepoFullName
     *
     * @throws Exception
     */
    public function iAmAddingNewGithubCommitFor($githubRepoFullName)
    {
        $this->repo = $this->getGithubRepoByFullName($githubRepoFullName);
    }

    /**
     * @When I look for details on :sha
     *
     * @param $sha
     */
    public function iLookForDetailsOn($sha)
    {
        $this->fetchRemoteCommitDetailsFor($sha);
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

    /**
     * @Then there should be github commit with :sha as full name in system
     *
     * @param $sha
     *
     * @throws Exception
     */
    public function thereShouldBeGithubCommitWithAsFullNameInSystem($sha)
    {
        $this->getGithubCommitBySha($sha);
    }

    /**
     * @Then I will get commit details
     */
    public function iWillGetCommitDetails()
    {
        if (null !== $this->error) {
            throw new Exception('No error was expected!');
        }
        if (null === $this->target) {
            throw new Exception('Some remote data was expected but none found');
        }
    }

    /**
     * @Then I will get an error that commit doesnt exist
     */
    public function iWillGetAnErrorThatCommitDoesntExist()
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

    private function setupGithubApiCommitService()
    {
        $this->service = $this->getService('null_dev_github_api.commit.service');
    }

    /**
     * @param $sha
     */
    private function fetchRemoteCommitDetailsFor($sha)
    {
        $githubCommit = $this->createCommitObjectFromSha($this->repo, $sha);

        try {
            $this->target = $this->service->fetch($githubCommit, $this->repo, $this->getCurrentUser());
        } catch (Exception $exception) {
            $this->error = $exception;
        }
    }
}
