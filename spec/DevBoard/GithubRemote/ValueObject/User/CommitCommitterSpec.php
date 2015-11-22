<?php
namespace spec\DevBoard\GithubRemote\ValueObject\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitCommitterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\User\CommitCommitter');
    }

    public function let()
    {
        $this->beConstructedWith('name', 'email', 'username');
    }

    public function it_will_expose_name_email_and_username()
    {
        $this->getName()->shouldReturn('name');
        $this->getEmail()->shouldReturn('email');
        $this->getUsername()->shouldReturn('username');
    }
    public function it_will_return_null_for_user_properties_not_supported_by_pus()
    {
        $this->getGithubId()->shouldReturn(null);
        $this->getAvatarUrl()->shouldReturn(null);
    }
}
