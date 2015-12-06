<?php
namespace DevBoard\GithubEvent\Payload;

/**
 * Class PullRequestPayload.
 */
class PullRequestPayload
{
    private $data;

    /**
     * PullRequestPayload constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getPullRequestDetails()
    {
        return $this->data['pull_request'];
    }

    public function getRepositoryDetails()
    {
        return $this->data['repository'];
    }

    /**
     * @return array
     */
    public function getHeadCommitDetails()
    {
        $data = [
            'sha' => $this->data['pull_request']['head']['sha'],
        ];

        return $data;
    }

    public function getPullRequestCreatorDetails()
    {
        return $this->data['sender'];
    }

    public function getPullRequestAssigneeDetails()
    {
        return $this->data['pull_request']['assignee'];
    }
}
