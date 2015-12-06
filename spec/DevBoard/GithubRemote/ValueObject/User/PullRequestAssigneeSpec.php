<?php
namespace spec\DevBoard\GithubRemote\ValueObject\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestAssigneeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\User\PullRequestAssignee');
    }
    public function let()
    {
        $this->beConstructedWith('id', 'username', 'avatar_url');
    }

    public function it_will_expose_id_username_and_avatar_url()
    {
        $this->getGithubId()->shouldReturn('id');
        $this->getUsername()->shouldReturn('username');
        $this->getAvatarUrl()->shouldReturn('avatar_url');
    }

    public function it_will_return_null_for_user_properties_not_supported_by_pus()
    {
        $this->getEmail()->shouldReturn(null);
        $this->getName()->shouldReturn(null);
    }
}
