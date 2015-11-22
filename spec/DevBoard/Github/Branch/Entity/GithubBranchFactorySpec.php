<?php
namespace spec\DevBoard\Github\Branch\Entity;

use DevBoard\Github\Branch\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Branch\Branch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubBranchFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Branch\Entity\GithubBranchFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_value_object(
        $mapper,
        GithubRepo $githubRepo,
        Branch $branchValueObject
    ) {
        $result = $this->createFromValueObject($githubRepo, $branchValueObject);

        $mapper->map($branchValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\Branch\Entity\GithubBranch');
    }
}
