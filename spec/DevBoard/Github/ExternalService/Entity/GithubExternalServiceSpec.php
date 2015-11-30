<?php
namespace spec\DevBoard\Github\ExternalService\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubExternalServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\ExternalService\Entity\GithubExternalService');
    }

    public function it_has_name()
    {
        $this->setName('name');
        $this->getName()->shouldReturn('name');
    }

    public function it_has_context()
    {
        $this->setContext('context');
        $this->getContext()->shouldReturn('context');
    }
}
