<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Organization;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrganizationInfoSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Organization\OrganizationInfo');
    }

    public function let()
    {
        $this->beConstructedWith('id', 'organization-name', 'http://avatar-url');
    }

    public function it_exposes_github_id()
    {
        $this->getGithubId()->shouldReturn('id');
    }

    public function it_exposes_organization_name()
    {
        $this->getOrganizationName()->shouldReturn('organization-name');
    }

    public function it_exposes_avatar_url()
    {
        $this->getAvatarUrl()->shouldReturn('http://avatar-url');
    }
}
