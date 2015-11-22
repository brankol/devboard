<?php
namespace spec\DevBoard\Github\Commit\Mapper;

use DateTime;
use DevBoard\Github\Commit\Entity\GithubCommit;
use NullDev\GithubApi\Commit\GithubCommitDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubCommitDataInterface $remote,
        GithubCommit $entity,
        DateTime $authorDate,
        DateTime $committerDate
    ) {
        $remote->getSha()->willReturn('name');
        $remote->getAuthorDate()->willReturn($authorDate);
        $remote->getCommitterDate()->willReturn($committerDate);
        $remote->getMessage()->willReturn('message');

        $entity->setSha('name')->shouldBeCalled();
        $entity->setAuthorDate($authorDate)->shouldBeCalled();
        $entity->setCommitterDate($committerDate)->shouldBeCalled();
        $entity->setMessage('message')->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
