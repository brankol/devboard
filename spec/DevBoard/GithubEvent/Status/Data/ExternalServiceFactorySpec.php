<?php
namespace spec\DevBoard\GithubEvent\Status\Data;

use DevBoard\GithubEvent\Payload\StatusPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExternalServiceFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Status\Data\ExternalServiceFactory');
    }

    public function it_will_create_remote_external_service_value_object(StatusPayload $statusPayload)
    {
        $statusPayload->getContext()->willReturn('context');

        $result = $this->create($statusPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\ExternalService\ExternalService');

        $result->getContext()->shouldReturn('context');
    }
}
