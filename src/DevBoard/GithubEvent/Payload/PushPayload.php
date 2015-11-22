<?php
namespace DevBoard\GithubEvent\Payload;

use Exception;

/**
 * Class PushPayload.
 */
class PushPayload
{
    private $data;

    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';

    /**
     * PushPayload constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isBranch()
    {
        if (strpos($this->getRef(), 'refs/heads/') === 0) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isTag()
    {
        if (strpos($this->getRef(), 'refs/tags/') === 0) {
            return true;
        }

        return false;
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function getBranchName()
    {
        if (!$this->isBranch()) {
            throw new Exception('This is not branch reference!');
        }

        return str_replace('refs/heads/', '', $this->getRef());
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function getTagName()
    {
        if (!$this->isTag()) {
            throw new Exception('This is not tag reference!');
        }

        return str_replace('refs/tags/', '', $this->getRef());
    }

    /**
     * @throws Exception
     *
     * @return string
     */
    public function getType()
    {
        if ($this->isCreate()) {
            return self::CREATED;
        } elseif ($this->isUpdate()) {
            return self::UPDATED;
        } elseif ($this->isDelete()) {
            return self::DELETED;
        }

        throw new Exception('Unknown push type??');
    }

    /**
     * @return bool
     */
    public function isCreate()
    {
        if ($this->getCreated() === true) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isUpdate()
    {
        if ($this->getCreated() === false && $this->getDeleted() === false) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        if ($this->getDeleted() === true) {
            return true;
        }

        return false;
    }

    public function getRepositoryDetails()
    {
        return $this->data['repository'];
    }

    public function getHeadCommitDetails()
    {
        return $this->data['head_commit'];
    }

    public function getCommitAuthorDetails()
    {
        return $this->data['head_commit']['author'];
    }

    public function getCommitCommiterDetails()
    {
        return $this->data['head_commit']['committer'];
    }

    private function getRef()
    {
        return $this->data['ref'];
    }

    private function getCreated()
    {
        return $this->data['created'];
    }

    private function getDeleted()
    {
        return $this->data['deleted'];
    }
}
