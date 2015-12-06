<?php
namespace spec\DevBoard\GithubRemote\ValueObject\PullRequest;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest');
    }

    public function let(DateTime $createdAt, DateTime $updatedAt)
    {
        $this->beConstructedWith(22, 'title', 'body', 10, true, false, $createdAt, $updatedAt);
    }

    public function it_holds_pull_request_number()
    {
        $this->getNumber()->shouldReturn(22);
    }

    public function it_holds_pull_request_title()
    {
        $this->getTitle()->shouldReturn('title');
    }

    public function it_holds_pull_request_body()
    {
        $this->getBody()->shouldReturn('body');
    }

    public function it_holds_pull_request_state()
    {
        $this->getState()->shouldReturn(10);
    }

    public function it_knows_if_pull_request_locked()
    {
        $this->isLocked()->shouldReturn(true);
    }

    public function it_knows_if_pull_request_merged()
    {
        $this->isMerged()->shouldReturn(false);
    }

    public function it_holds_datetime_when_was_pull_request_created_on_github($createdAt)
    {
        $this->getGithubCreatedAt()->shouldReturn($createdAt);
    }

    public function it_holds_datetime_when_was_pull_request_last_update_on_github($updatedAt)
    {
        $this->getGithubUpdatedAt()->shouldReturn($updatedAt);
    }
}
