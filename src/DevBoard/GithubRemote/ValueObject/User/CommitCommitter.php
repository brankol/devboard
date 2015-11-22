<?php
namespace DevBoard\GithubRemote\ValueObject\User;

use NullDev\GithubApi\User\GithubUserDataInterface;

/**
 * Class CommitCommitter.
 */
class CommitCommitter implements GithubUserDataInterface
{
    private $name;
    private $email;
    private $username;

    /**
     * CommitAuthor constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $username
     */
    public function __construct($name, $email, $username)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     */
    public function getGithubId()
    {
        return null;
    }

    /**
     */
    public function getAvatarUrl()
    {
        return null;
    }
}
