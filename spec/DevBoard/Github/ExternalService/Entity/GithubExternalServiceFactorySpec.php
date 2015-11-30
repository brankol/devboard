<?php
namespace spec\DevBoard\Github\ExternalService\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubExternalServiceFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\ExternalService\Entity\GithubExternalServiceFactory');
    }

    public function it_will_create_instance_from_context_where_both_name_and_context_are_same($context)
    {
        $result = $this->createFromContext($context);

        $result->shouldBeAnInstanceOf('DevBoard\Github\ExternalService\Entity\GithubExternalService');
        $result->getName()->shouldReturn($context);
        $result->getContext()->shouldReturn($context);
    }
}
