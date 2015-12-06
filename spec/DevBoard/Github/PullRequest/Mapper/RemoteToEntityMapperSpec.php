<?php
namespace spec\DevBoard\Github\PullRequest\Mapper;

use DevBoard\Github\PullRequest\Entity\GithubPullRequest;
use NullDev\GithubApi\PullRequest\GithubPullRequestDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubPullRequestDataInterface $remote,
        GithubPullRequest $entity

    ) {
        $remote->getTitle()->willReturn('name');

        $entity->setTitle('name')->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
