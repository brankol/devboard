<?php
namespace spec\DevBoard\GithubEvent\Payload;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\Github\WebHook\Data\PushEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PayloadFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Payload\PayloadFactory');
    }

    public function it_instantiates_payload_object_from_received_webhook_event(PushEvent $pushEvent)
    {
        $pushEvent->getPayload()->willReturn(['data']);
        $this->create($pushEvent)->shouldReturnAnInstanceOf('DevBoard\GithubEvent\Payload\PushPayload');
    }

    public function it_will_throw_exception_on_unknown_webhook_event(AbstractEvent $abstractEvent)
    {
        $this->shouldThrow('Exception')->duringCreate($abstractEvent);
    }
}
