<?php
namespace spec\DevBoard\Github\WebHook\Data;

use DevBoard\Github\WebHook\WebHookSignature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PushEventSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\WebHook\Data\PushEvent');
    }

    public function let(WebHookSignature $signature)
    {
        $this->beConstructedWith($signature, '{}');
    }

    public function it_exposes_signature($signature)
    {
        $this->getSignature()->shouldReturn($signature);
    }

    public function it_exposes_raw_payload()
    {
        $this->getRawPayload()->shouldReturn('{}');
    }

    public function it_exposes_json_decoded_payload()
    {
        $this->getPayload()->shouldReturn([]);
    }
}
