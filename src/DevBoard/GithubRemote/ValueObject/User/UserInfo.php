<?php
namespace DevBoard\GithubRemote\ValueObject\User;

use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class UserInfo.
 */
class UserInfo implements GithubUserDataInterface
{
    /** @var string */
    private $githubId;
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $username;
    /** @var string */
    private $avatarUrl;

    /**
     * UserInfo constructor.
     *
     * @param string $githubId
     * @param string $name
     * @param string $email
     * @param string $username
     * @param string $avatarUrl
     */
    public function __construct($githubId, $name, $email, $username, $avatarUrl)
    {
        $this->githubId  = $githubId;
        $this->name      = $name;
        $this->email     = $email;
        $this->username  = $username;
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}
