<?php
namespace spec\DevBoard\Github\Branch\Mapper;

use DevBoard\Github\Branch\Entity\GithubBranch;
use NullDev\GithubApi\Branch\GithubBranchDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Branch\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubBranchDataInterface $remote,
        GithubBranch $entity

    ) {
        $remote->getName()->willReturn('name');

        $entity->setName('name')->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
