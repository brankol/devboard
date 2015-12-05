<?php
namespace spec\DevBoard\GithubEvent\Push;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Branch\BranchHandler;
use DevBoard\GithubEvent\Push\Tag\TagHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PushHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\PushHandler');
    }

    public function let(BranchHandler $branchHandler, TagHandler $tagHandler)
    {
        $this->beConstructedWith($branchHandler, $tagHandler);
    }

    public function it_will_handle_create_branch_push_event($branchHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(true);
        $pushPayload->isTag()->willReturn(false);
        $pushPayload->isCreate()->willReturn(true);

        $branchHandler->create($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_handle_update_branch_push_event($branchHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(true);
        $pushPayload->isTag()->willReturn(false);
        $pushPayload->isCreate()->willReturn(false);
        $pushPayload->isUpdate()->willReturn(true);

        $branchHandler->update($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_handle_delete_branch_push_event($branchHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(true);
        $pushPayload->isTag()->willReturn(false);
        $pushPayload->isCreate()->willReturn(false);
        $pushPayload->isUpdate()->willReturn(false);
        $pushPayload->isDelete()->willReturn(true);

        $branchHandler->delete($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_handle_create_tag_push_event($tagHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(false);
        $pushPayload->isTag()->willReturn(true);
        $pushPayload->isCreate()->willReturn(true);

        $tagHandler->create($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_handle_update_tag_push_event($tagHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(false);
        $pushPayload->isTag()->willReturn(true);
        $pushPayload->isCreate()->willReturn(false);
        $pushPayload->isUpdate()->willReturn(true);

        $tagHandler->update($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_handle_delete_tag_push_event($tagHandler, PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(false);
        $pushPayload->isTag()->willReturn(true);
        $pushPayload->isCreate()->willReturn(false);
        $pushPayload->isUpdate()->willReturn(false);
        $pushPayload->isDelete()->willReturn(true);

        $tagHandler->delete($pushPayload)->willReturn(true)->shouldBeCalled();

        $this->process($pushPayload)->shouldReturn(true);
    }

    public function it_will_throw_exception_if_not_branch_or_tag_push_event(PushPayload $pushPayload)
    {
        $pushPayload->isBranch()->willReturn(false);
        $pushPayload->isTag()->willReturn(false);
        $this->shouldThrow('Exception')->duringProcess($pushPayload);
    }
}
