<?php
namespace spec\DevBoard\GithubRemote\ValueObject\CommitStatus;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitStatusSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\CommitStatus\CommitStatus');
    }

    public function let()
    {
        $this->beConstructedWith('status', 'description');
    }

    public function it_exposes_status_and_description()
    {
        $this->getStatus()->shouldReturn('status');
        $this->getDescription()->shouldReturn('description');
    }
}
