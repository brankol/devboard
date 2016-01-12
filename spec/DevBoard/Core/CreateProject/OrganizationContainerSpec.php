<?php
namespace spec\DevBoard\Core\CreateProject;

use DevBoard\Core\CreateProject\RepositoryCollection;
use DevBoard\GithubRemote\ValueObject\Organization\OrganizationInfo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrganizationContainerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\OrganizationContainer');
    }

    public function let(OrganizationInfo $organization, RepositoryCollection $repositoryCollection)
    {
        $organization->getOrganizationName()->willReturn('owner-name');
        $repositoryCollection->count()->willReturn(1);
        $this->beConstructedWith($organization, $repositoryCollection);
    }

    public function it_will_expose_organization_name()
    {
        $this->getName()->shouldReturn('owner-name');
    }

    public function it_will_expose_repositories($repositoryCollection)
    {
        $this->getRepositories()->shouldReturn($repositoryCollection);
    }

    public function it_has_repo_count()
    {
        $this->getCount()->shouldReturn(1);
    }
}
