<?php
namespace DevBoard\Github\Commit;

use DateTime;
use DevBoard\Github\Repo\GithubRepo;
use DevBoard\Github\User\GithubUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GithubCommit.
 *
 * @ORM\Table(name="GithubCommits", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_repo_sha",
 *                                 columns={"githubRepoId", "sha"})})
 * @ORM\Entity(repositoryClass="DevBoard\Github\Commit\GithubCommitRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class GithubCommit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="DevBoard\Github\Repo\GithubRepo", inversedBy="commits")
     * @ORM\JoinColumn(name="githubRepoId", referencedColumnName="id")
     */
    protected $githubRepo;

    /**
     * @var string
     *
     * @ORM\Column(name="sha", type="string", length=255)
     */
    private $sha;

    /**
     * @ORM\ManyToOne(targetEntity="DevBoard\Github\User\GithubUser", inversedBy="authored",cascade={"persist"})
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="authorDate", type="datetime")
     */
    private $authorDate;

    /**
     * @ORM\ManyToOne(targetEntity="DevBoard\Github\User\GithubUser", inversedBy="committed",cascade={"persist"})
     * @ORM\JoinColumn(name="committerId", referencedColumnName="id")
     */
    private $committer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="committerDate", type="datetime")
     */
    private $committerDate;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="internalStatus", type="integer", nullable=true)
     */
    private $internalStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="githubStatus", type="integer", nullable=true)
     */
    private $githubStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return GithubRepo
     */
    public function getGithubRepo()
    {
        return $this->githubRepo;
    }

    /**
     * @param GithubRepo $githubRepo
     *
     * @return $this
     */
    public function setGithubRepo(GithubRepo $githubRepo)
    {
        $this->githubRepo = $githubRepo;

        return $this;
    }

    /**
     * Set sha.
     *
     * @param string $sha
     *
     * @return GithubCommit
     */
    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    /**
     * Get sha.
     *
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * Set author.
     *
     * @param GithubUser $author
     *
     * @return GithubCommit
     */
    public function setAuthor(GithubUser $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return GithubUser
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set authorDate.
     *
     * @param \DateTime $authorDate
     *
     * @return GithubCommit
     */
    public function setAuthorDate($authorDate)
    {
        $this->authorDate = $authorDate;

        return $this;
    }

    /**
     * Get authorDate.
     *
     * @return \DateTime
     */
    public function getAuthorDate()
    {
        return $this->authorDate;
    }

    /**
     * Set committer.
     *
     * @param GithubUser $committer
     *
     * @return GithubCommit
     */
    public function setCommitter(GithubUser $committer)
    {
        $this->committer = $committer;

        return $this;
    }

    /**
     * Get committer.
     *
     * @return GithubUser
     */
    public function getCommitter()
    {
        return $this->committer;
    }

    /**
     * Set committerDate.
     *
     * @param \DateTime $committerDate
     *
     * @return GithubCommit
     */
    public function setCommitterDate($committerDate)
    {
        $this->committerDate = $committerDate;

        return $this;
    }

    /**
     * Get committerDate.
     *
     * @return \DateTime
     */
    public function getCommitterDate()
    {
        return $this->committerDate;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return GithubCommit
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getInternalStatus()
    {
        return $this->internalStatus;
    }

    /**
     * @param string $internalStatus
     *
     * @return $this
     */
    public function setInternalStatus($internalStatus)
    {
        $this->internalStatus = $internalStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getGithubStatus()
    {
        return $this->githubStatus;
    }

    /**
     * @param string $githubStatus
     *
     * @return $this
     */
    public function setGithubStatus($githubStatus)
    {
        $this->githubStatus = $githubStatus;

        return $this;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return GithubCommit
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param DateTime|string $updatedAt
     *
     * @return GithubCommit
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function doCreatedValue()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function doUpdatedValue()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
