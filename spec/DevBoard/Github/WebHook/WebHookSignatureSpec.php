<?php
namespace spec\DevBoard\Github\WebHook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebHookSignatureSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\WebHook\WebHookSignature');
    }

    public function let($algorithm = 'sha1', $signature = 'abc123')
    {
        $this->beConstructedWith($algorithm, $signature);
    }

    public function it_exposes_algorithm_used($algorithm)
    {
        $this->getAlgorithm()->shouldReturn($algorithm);
    }

    public function it_exposes_signature($signature)
    {
        $this->getSignature()->shouldReturn($signature);
    }
}
