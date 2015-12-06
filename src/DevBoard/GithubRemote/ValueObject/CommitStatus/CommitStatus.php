<?php
namespace DevBoard\GithubRemote\ValueObject\CommitStatus;

/**
 * Class CommitStatus.
 */
class CommitStatus
{
    private $status;
    private $description;
    private $targetUrl;

    /**
     * CommitStatus constructor.
     *
     * @param $status
     * @param $description
     */
    public function __construct($status, $description, $targetUrl)
    {
        $this->status      = $status;
        $this->description = $description;
        $this->targetUrl   = $targetUrl;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }
}
