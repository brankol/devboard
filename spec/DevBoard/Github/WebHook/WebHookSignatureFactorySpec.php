<?php
namespace spec\DevBoard\Github\WebHook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebHookSignatureFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\WebHook\WebHookSignatureFactory');
    }

    public function it_will_create_signature_instance()
    {
        $this->create('sha1=abc123')->shouldReturnAnInstanceOf('DevBoard\Github\WebHook\WebHookSignature');
    }
}
