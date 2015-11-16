<?php
namespace spec\DevBoard\Github\User\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\Entity\GithubUserFactory');
    }

    public function it_will_create_instance_using_username()
    {
        $this->create('username')->shouldReturnAnInstanceOf('DevBoard\Github\User\Entity\GithubUser');
    }
}
