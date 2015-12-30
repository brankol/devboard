<?php
namespace spec\DevBoard\Github\Hook\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubHookSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Hook\Entity\GithubHook');
    }
}
