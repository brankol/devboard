<?php
namespace spec\DevBoard\Github\WebHook;

use DevBoard\Github\WebHook\WebHookSignature;
use DevBoard\Github\WebHook\WebHookSignatureFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;

class WebHookFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\WebHook\WebHookFactory');
    }

    public function let(WebHookSignatureFactory $signatureFactory)
    {
        $this->beConstructedWith($signatureFactory);
    }

    public function it_will_create_push_event(
        $signatureFactory,
        WebHookSignature $signature,
        Request $request,
        HeaderBag $headerBag
    ) {
        $request->headers = $headerBag;

        $headerBag->get('X-GitHub-Event')->willReturn('push');
        $headerBag->get('X-Hub-Signature')->willReturn('sha1=abc123');

        $signatureFactory->create('sha1=abc123')->willReturn($signature);
        $request->getContent()->willReturn('{}');

        $this->create($request)->shouldReturnAnInstanceOf('DevBoard\Github\WebHook\Data\PushEvent');
    }
}
