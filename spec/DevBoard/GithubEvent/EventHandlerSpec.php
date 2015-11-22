<?php
namespace spec\DevBoard\GithubEvent;

use DevBoard\Github\WebHook\Data\PushEvent;
use DevBoard\GithubEvent\Payload\PayloadFactory;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\PushHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\EventHandler');
    }

    public function let(PayloadFactory $payloadFactory, PushHandler $pushHandler)
    {
        $this->beConstructedWith($payloadFactory, $pushHandler);
    }

    public function it_will_handle_push_event(
        $payloadFactory,
        $pushHandler,
        PushEvent $pushEvent,
        PushPayload $pushPayload
    ) {
        $payloadFactory->create($pushEvent)->willReturn($pushPayload);

        $pushHandler->process($pushPayload)->willReturn(true);

        $this->handle($pushEvent)->shouldReturn(true);
    }
}
