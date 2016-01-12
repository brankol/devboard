<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Repo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoInfoSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Repo\RepoInfo');
    }

    public function let()
    {
        $this->beConstructedWith(
            'owner',
            'name'
        );
    }

    public function it_holds_repo_owner_name()
    {
        $this->getOwner()->shouldReturn('owner');
    }

    public function it_holds_repo_name()
    {
        $this->getName()->shouldReturn('name');
    }

    public function it_holds_repo_full_name()
    {
        $this->getFullName()->shouldReturn('owner/name');
    }
}
