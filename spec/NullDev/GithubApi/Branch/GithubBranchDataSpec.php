<?php
namespace spec\NullDev\GithubApi\Branch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubBranchDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Branch\GithubBranchData');
    }

    public function let($name)
    {
        $this->beConstructedWith($name, ['commitData']);
    }

    public function it_exposes_all_constructor_params_via_getters(
        $name
    ) {
        $this->getName()->shouldReturn($name);
        $this->getCommitData()->shouldReturn(['commitData']);
    }
}
