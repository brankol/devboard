<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Branch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Branch\Branch');
    }

    public function let()
    {
        $this->beConstructedWith('name');
    }

    public function it_will_expose_name()
    {
        $this->getName()->shouldReturn('name');
    }
}
