<?php
namespace spec\DevBoard\Core\CreateProject;

use DevBoard\Core\CreateProject\RepositoryCollection;
use DevBoard\GithubRemote\ValueObject\User\UserInfo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserContainerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\UserContainer');
    }

    public function let(UserInfo $user, RepositoryCollection $repositoryCollection)
    {
        $user->getUsername()->willReturn('owner-name');
        $repositoryCollection->count()->willReturn(1);
        $this->beConstructedWith($user, $repositoryCollection);
    }

    public function it_will_expose_username_of_user()
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
