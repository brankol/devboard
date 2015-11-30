<?php
namespace spec\DevBoard\Github\CommitStatus;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitStatusStateSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\CommitStatus\GithubCommitStatusState');
    }
}
