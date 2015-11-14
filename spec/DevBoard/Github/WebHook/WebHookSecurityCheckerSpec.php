<?php
namespace spec\DevBoard\Github\WebHook;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\Github\WebHook\WebHookSignature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebHookSecurityCheckerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\WebHook\WebHookSecurityChecker');
    }

    public function let()
    {
        $this->beConstructedWith('secret');
    }

    public function it_will_return_true_if_check_passes(AbstractEvent $event, WebHookSignature $signature)
    {
        $event->getSignature()->willReturn($signature);
        $signature->getAlgorithm()->willReturn('sha1');
        $signature->getSignature()->willReturn('5d61605c3feea9799210ddcb71307d4ba264225f');
        $event->getRawPayload()->willReturn('{}');

        $this->check($event)->shouldReturn(true);
    }

    public function it_will_return_false_on_check_fail(AbstractEvent $event, WebHookSignature $signature)
    {
        $event->getSignature()->willReturn($signature);
        $signature->getAlgorithm()->willReturn('sha1');
        $signature->getSignature()->willReturn('abc123');
        $event->getRawPayload()->willReturn('{}');
        $this->check($event)->shouldReturn(false);
    }
}
