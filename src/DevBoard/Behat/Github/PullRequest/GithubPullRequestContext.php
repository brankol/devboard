<?php
namespace DevBoard\Behat\Github\PullRequest;

use DevBoard\Behat\Github\Repo\DataTrait as RepoDataTrait;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use Resources\Behat\DomainContext;

/**
 * Class GithubPullRequestContext.
 */
class GithubPullRequestContext extends DomainContext
{
    use DataTrait;
    use RepoDataTrait;

    private $payload;

    /**
     * @Given I am receiving pull request opened event from Github
     */
    public function iAmReceivingPullRequestOpenedEventFromGithub()
    {
        $this->payload = $this->getPullRequestPayload('opened-pull-request.json');
    }

    /**
     * @Given I am receiving pull request sync event from Github
     */
    public function iAmReceivingPullRequestSyncEventFromGithub()
    {
        $this->payload = $this->getPullRequestPayload('sync-pull-request.json');
    }

    /**
     * @Given I am receiving pull request labeled event from Github
     */
    public function iAmReceivingPullRequestLabeledEventFromGithub()
    {
        $this->payload = $this->getPullRequestPayload('labeled-pull-request.json');
    }

    /**
     * @Given I am receiving pull request closed event from Github
     */
    public function iAmReceivingPullRequestClosedEventFromGithub()
    {
        $this->payload = $this->getPullRequestPayload('closed-pull-request.json');
    }

    /**
     * @When I process pull request event
     */
    public function iProcessPullRequestEvent()
    {
        $service = $this->getService('github.event.pull_request.handler');

        $service->create($this->payload);
    }

    /**
     * @param $fileName
     *
     * @return PullRequestPayload
     */
    private function getPullRequestPayload($fileName)
    {
        $data = $this->getTestSampleData($fileName);

        return new PullRequestPayload(json_decode($data, true));
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    private function getTestSampleData($fileName)
    {
        $rootDir  = $this->getService('kernel')->getRootDir();
        $filePath = $rootDir.'/../src/DevBoard/GithubEvent/Tests/sample-data/'.$fileName;

        return file_get_contents($filePath);
    }
}
