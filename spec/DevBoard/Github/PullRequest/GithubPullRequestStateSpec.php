<?php
namespace spec\DevBoard\Github\PullRequest;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestStateSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\GithubPullRequestState');
    }
}
