<?php
namespace spec\DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\Data\TagFactory');
    }

    public function it_will_create_remote_tag_value_object(PushPayload $pushPayload)
    {
        $pushPayload->getTagName()->willReturn('name');

        $result = $this->create($pushPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Tag\Tag');
        $result->getName()->shouldReturn('name');
    }
}
