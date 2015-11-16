<?php
namespace NullDev\GithubApi\User;

/**
 * Class GithubUserData.
 */
class GithubUserData implements GithubUserDataInterface
{
    /** @var string */
    private $githubId;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $name;

    /** @var string */
    private $avatarUrl;

    /**
     * GithubUserData constructor.
     *
     * @param string $githubId
     * @param string $username
     * @param string $email
     * @param string $name
     * @param string $avatarUrl
     */
    public function __construct($githubId, $username, $email, $name, $avatarUrl)
    {
        $this->githubId  = $githubId;
        $this->username  = $username;
        $this->email     = $email;
        $this->name      = $name;
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
    public function getUsername()
    {
        return $this->username;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}
