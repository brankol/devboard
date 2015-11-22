<?php
namespace spec\DevBoard\Github\Repo\Entity;

use DevBoard\Github\Repo\Mapper\RemoteToEntityMapper;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\Entity\GithubRepoFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_full_name($fullName)
    {
        $this->create('owner/name')->shouldReturnAnInstanceOf('DevBoard\Github\Repo\Entity\GithubRepo');
    }

    public function it_will_create_instance_using_value_object($mapper, Repo $repoValueObject)
    {
        $result = $this->createFromValueObject($repoValueObject);

        $mapper->map($repoValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\Repo\Entity\GithubRepo');
    }
}
