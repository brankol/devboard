<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Tag;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Tag\Tag');
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
