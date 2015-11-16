<?php
namespace spec\NullDev\GithubApi\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\User\GithubUserData');
    }

    public function let($githubId, $username, $email, $name, $avatarUrl)
    {
        $this->beConstructedWith($githubId, $username, $email, $name, $avatarUrl);
    }
}
