<?php
namespace DevBoard\GithubRemote\ValueObject\Organization;

/**
 * Class OrganizationInfo.
 */
class OrganizationInfo
{
    /** @var string */
    private $githubId;
    /** @var string */
    private $organizationName;
    /** @var string */
    private $avatarUrl;

    /**
     * OrganizationInfo constructor.
     *
     * @param string $githubId
     * @param string $organizationName
     * @param string $avatarUrl
     */
    public function __construct($githubId, $organizationName, $avatarUrl)
    {
        $this->githubId         = $githubId;
        $this->organizationName = $organizationName;
        $this->avatarUrl        = $avatarUrl;
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
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}
