<?php
namespace spec\DevBoard\Github\Repo\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\Entity\GithubRepoFactory');
    }

    public function it_will_create_instance_using_full_name($fullName)
    {
        $this->create('owner/name')->shouldReturnAnInstanceOf('DevBoard\Github\Repo\Entity\GithubRepo');
    }
}
