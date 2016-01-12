<?php
namespace spec\DevBoard\GithubRemote\ValueObject\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserInfoSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\User\UserInfo');
    }

    public function let()
    {
        $this->beConstructedWith('github-id', 'name', 'email', 'username', 'http://avatar-url');
    }

    public function it_will_expose_user_details()
    {
        $this->getGithubId()->shouldReturn('github-id');
        $this->getName()->shouldReturn('name');
        $this->getEmail()->shouldReturn('email');
        $this->getUsername()->shouldReturn('username');
        $this->getAvatarUrl()->shouldReturn('http://avatar-url');
    }
}
