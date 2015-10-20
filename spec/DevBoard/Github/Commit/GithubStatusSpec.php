<?php
namespace spec\DevBoard\Github\Commit;

use DevBoard\Github\Commit\GithubState;
use DevBoard\Github\Commit\GithubStatus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubStatusSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\GithubStatus');
    }
}
