<?php
namespace spec\DevBoard\GithubEvent\Status\Data;

use DevBoard\GithubEvent\Payload\StatusPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitStatusFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Status\Data\CommitStatusFactory');
    }

    public function it_will_create_remote_commit_status_value_object(StatusPayload $statusPayload)
    {
        $statusPayload->getState()->willReturn('state');
        $statusPayload->getDescription()->willReturn('description');
        $statusPayload->getTargetUrl()->willReturn('url');

        $result = $this->create($statusPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\CommitStatus\CommitStatus');

        $result->getStatus()->shouldReturn('state');
        $result->getDescription()->shouldReturn('description');
    }
}
