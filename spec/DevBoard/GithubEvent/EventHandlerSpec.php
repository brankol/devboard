<?php
namespace spec\DevBoard\GithubEvent;

use DevBoard\Github\WebHook\Data\PullRequestEvent;
use DevBoard\Github\WebHook\Data\PushEvent;
use DevBoard\Github\WebHook\Data\StatusEvent;
use DevBoard\GithubEvent\Payload\PayloadFactory;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubEvent\PullRequest\PullRequestHandler;
use DevBoard\GithubEvent\Push\PushHandler;
use DevBoard\GithubEvent\Status\StatusHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\EventHandler');
    }

    public function let(
        PayloadFactory $payloadFactory,
        PushHandler $pushHandler,
        StatusHandler $statusHandler,
        PullRequestHandler $pullRequestHandler
    ) {
        $this->beConstructedWith($payloadFactory, $pushHandler, $statusHandler, $pullRequestHandler);
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

    public function it_will_handle_status_event(
        $payloadFactory,
        $statusHandler,
        StatusEvent $statusEvent,
        StatusPayload $statusPayload
    ) {
        $payloadFactory->create($statusEvent)->willReturn($statusPayload);

        $statusHandler->process($statusPayload)->willReturn(true);

        $this->handle($statusEvent)->shouldReturn(true);
    }

    public function it_will_handle_pull_request_event(
        $payloadFactory,
        $statusHandler,
        PullRequestEvent $pullRequestEvent,
        PullRequestPayload $pullRequestPayload
    ) {
        $payloadFactory->create($pullRequestEvent)->willReturn($pullRequestPayload);

        $statusHandler->process($pullRequestPayload)->willReturn(true);

        $this->handle($pullRequestEvent)->shouldReturn(true);
    }
}
