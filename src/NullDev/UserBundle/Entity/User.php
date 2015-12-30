<?php
namespace NullDev\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="NullDev\UserBundle\Entity\UserRepository")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              name     = "email",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true,
 *              unique = true,
 *          )
 *      ),
 *     @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              name     = "email_canonical",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true,
 *              unique = true,
 *          )
 *      )
 * })
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="profileName", type="string", length=255, nullable=true) */
    protected $profileName;

    /** @ORM\Column(name="githubProfileName", type="string", length=255, nullable=true) */
    protected $githubProfileName;

    /** @ORM\Column(name="githubUserName", type="string", length=255, nullable=true, unique=true) */
    protected $githubUserName;

    /** @ORM\Column(name="githubId", type="string", length=255, nullable=true, unique=true) */
    protected $githubId;

    /** @ORM\Column(name="githubAccessToken", type="string", length=255, nullable=true, unique=true) */
    protected $githubAccessToken;

    /** @ORM\OneToMany(targetEntity="DevBoard\Core\Project\Entity\Project", mappedBy="user") */
    protected $projects;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->projects = new ArrayCollection();
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            $email = null;
        }

        $this->email = $email;

        return $this;
    }

    /**
     * @param string $emailCanonical
     *
     * @return $this
     */
    public function setEmailCanonical($emailCanonical)
    {
        if (empty($emailCanonical)) {
            $emailCanonical = null;
        }

        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * @param mixed $profileName
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;
    }

    /**
     * @return mixed
     */
    public function getGithubProfileName()
    {
        return $this->githubProfileName;
    }

    /**
     * @param mixed $githubProfileName
     */
    public function setGithubProfileName($githubProfileName)
    {
        $this->githubProfileName = $githubProfileName;
    }

    /**
     * @return mixed
     */
    public function getGithubUserName()
    {
        return $this->githubUserName;
    }

    /**
     * @param mixed $githubUserName
     */
    public function setGithubUserName($githubUserName)
    {
        $this->githubUserName = $githubUserName;
    }

    /**
     * @return mixed
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @param mixed $githubId
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
    }

    /**
     * @return mixed
     */
    public function getGithubAccessToken()
    {
        return $this->githubAccessToken;
    }

    /**
     * @param mixed $githubAccessToken
     */
    public function setGithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param ArrayCollection $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }
}
