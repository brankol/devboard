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

    public function let(DateTime $authorDate, DateTime $committerDate)
    {
        $this->beConstructedWith('sha', $authorDate, $committerDate, 'Message');
    }

    public function it_exposes_sha_and_message($authorDate, $committerDate)
    {
        $this->getSha()->shouldReturn('sha');
        $this->getMessage()->shouldReturn('Message');
        $this->getAuthorDate()->shouldReturn($authorDate);
        $this->getCommitterDate()->shouldReturn($committerDate);
    }
}
