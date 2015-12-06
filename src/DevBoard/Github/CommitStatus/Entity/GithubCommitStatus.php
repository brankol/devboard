<?php
namespace DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use Resources\Entity\BaseEntity;

/**
 * Class GithubCommitStatus.
 */
class GithubCommitStatus extends BaseEntity
{
    private $githubCommit;
    private $githubExternalService;
    private $targetUrl;

    private $state;

    /**
     * @return GithubCommit
     */
    public function getGithubCommit()
    {
        return $this->githubCommit;
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return $this
     */
    public function setGithubCommit(GithubCommit $githubCommit)
    {
        $this->githubCommit = $githubCommit;

        return $this;
    }

    /**
     * @return GithubExternalService
     */
    public function getGithubExternalService()
    {
        return $this->githubExternalService;
    }

    /**
     * @param GithubExternalService $githubExternalService
     *
     * @return $this
     */
    public function setGithubExternalService(GithubExternalService $githubExternalService)
    {
        $this->githubExternalService = $githubExternalService;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }

    /**
     * @param mixed $targetUrl
     *
     * @return $this
     */
    public function setTargetUrl($targetUrl)
    {
        $this->targetUrl = $targetUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return int
     */
    public function getStateText()
    {
        return GithubCommitStatusState::getText((int) $this->state);
    }

    /**
     * @return int
     */
    public function getStateColor()
    {
        return GithubCommitStatusState::getColor((int) $this->state);
    }
}
