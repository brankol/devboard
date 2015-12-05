<?php
namespace spec\DevBoard\Github\Tag\Mapper;

use DevBoard\Github\Tag\Entity\GithubTag;
use NullDev\GithubApi\Tag\GithubTagDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Tag\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubTagDataInterface $remote,
        GithubTag $entity

    ) {
        $remote->getName()->willReturn('name');

        $entity->setName('name')->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
