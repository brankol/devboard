<?php
namespace DevBoard\GithubEvent\Payload;

/**
 * Class StatusPayload.
 */
class StatusPayload
{
    private $data;

    /**
     * PushPayload constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getSha()
    {
        return $this->data['sha'];
    }

    public function getGithubRepoFullName()
    {
        return $this->data['name'];
    }

    public function getContext()
    {
        return $this->data['context'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getState()
    {
        return $this->data['state'];
    }

    public function getRepositoryDetails()
    {
        return $this->data['repository'];
    }

    public function getCommitDetails()
    {
        return $this->data['commit'];
    }

    public function getTargetUrl()
    {
        return $this->data['target_url'];
    }
}
