<?php
namespace spec\DevBoard\Github\User\Entity;

use DevBoard\Github\User\Mapper\RemoteToEntityMapper;
use NullDev\GithubApi\User\GithubUserDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\Entity\GithubUserFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_username()
    {
        $this->create('username')->shouldReturnAnInstanceOf('DevBoard\Github\User\Entity\GithubUser');
    }

    public function it_will_create_instance_using_value_object($mapper, GithubUserDataInterface $userValueObject)
    {
        $result = $this->createFromValueObject($userValueObject);

        $mapper->map($userValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\User\Entity\GithubUser');
    }
}
