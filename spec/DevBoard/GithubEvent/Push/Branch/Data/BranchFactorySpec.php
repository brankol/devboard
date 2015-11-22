<?php
namespace spec\DevBoard\GithubEvent\Push\Branch\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Branch\Data\BranchFactory');
    }

    public function it_will_create_remote_branch_value_object(PushPayload $pushPayload)
    {
        $pushPayload->getBranchName()->willReturn('name');

        $result = $this->create($pushPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Branch\Branch');
        $result->getName()->shouldReturn('name');
    }
}
