<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch\Data;

use NullDev\GithubApi\Branch\GithubBranchData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BranchFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\Data\BranchFactory');
    }

    public function it_will_create_remote_branch_value_object(GithubBranchData $githubBranchData)
    {
        $githubBranchData->getName()->willReturn('name');

        $result = $this->create($githubBranchData);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Branch\Branch');
        $result->getName()->shouldReturn('name');
    }
}
