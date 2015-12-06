<?php
namespace DevBoard\GithubRemote\ValueObject\User;

use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class PullRequestCreator.
 */
class PullRequestCreator implements GithubUserDataInterface
{
    private $githubId;
    private $username;
    private $avatarUrl;

    /**
     * PullRequestAssignee constructor.
     *
     * @param $githubId
     * @param $username
     * @param $avatarUrl
     */
    public function __construct($githubId, $username, $avatarUrl)
    {
        $this->githubId  = $githubId;
        $this->username  = $username;
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return mixed
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     */
    public function getEmail()
    {
        return null;
    }

    /**
     */
    public function getName()
    {
        return null;
    }
}
