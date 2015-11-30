<?php
namespace spec\DevBoard\GithubRemote\ValueObject\ExternalService;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExternalServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\ExternalService\ExternalService');
    }

    public function let()
    {
        $this->beConstructedWith('context');
    }

    public function it_exposes_context()
    {
        $this->getContext()->shouldReturn('context');
    }
}
