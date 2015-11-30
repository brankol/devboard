<?php
namespace DevBoard\GithubRemote\ValueObject\CommitStatus;

/**
 * Class CommitStatus.
 */
class CommitStatus
{
    private $status;
    private $description;

    /**
     * CommitStatus constructor.
     *
     * @param $status
     * @param $description
     */
    public function __construct($status, $description)
    {
        $this->status      = $status;
        $this->description = $description;
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
}
