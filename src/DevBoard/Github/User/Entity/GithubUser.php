<?php
namespace DevBoard\Github\User\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use NullDev\GithubApi\User\GithubUserDataInterface;
use Resources\Entity\BaseEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GithubUser.
 *
 * @UniqueEntity("githubId")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class GithubUser extends BaseEntity implements GithubUserDataInterface
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
     * Set githubId.
     *
     * @param string $githubId
     *
     * @return GithubUser
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * Get githubId.
     *
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return GithubUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return GithubUser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
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
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set avatarUrl.
     *
     * @param string $avatarUrl
     *
     * @return GithubUser
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get avatarUrl.
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
