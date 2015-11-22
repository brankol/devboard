<?php
namespace spec\DevBoard\GithubEvent\Push\Tag;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\TagHandler');
    }

    public function it_will_create(PushPayload $pushPayload)
    {
        $this->create($pushPayload)->shouldReturn(true);
    }
    public function it_will_update(PushPayload $pushPayload)
    {
        $this->update($pushPayload)->shouldReturn(true);
    }
    public function it_will_delete(PushPayload $pushPayload)
    {
        $this->delete($pushPayload)->shouldReturn(true);
    }
}
