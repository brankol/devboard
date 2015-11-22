<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Commit;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Commit\Commit');
    }

    public function let(DateTime $timestamp)
    {
        $this->beConstructedWith('sha', $timestamp, 'Message');
    }

    public function it_exposes_sha_and_message()
    {
        $this->getSha()->shouldReturn('sha');
        $this->getMessage()->shouldReturn('Message');
    }

    public function it_exposes_timestamp_as_author_date_and_committer_dates($timestamp)
    {
        $this->getAuthorDate()->shouldReturn($timestamp);
        $this->getCommitterDate()->shouldReturn($timestamp);
    }
}
