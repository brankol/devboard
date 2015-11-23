<?php
namespace spec\DevBoard\Core\Project\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProjectFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\Project\Entity\ProjectFactory');
    }

    public function it_will_create_new_instance()
    {
        $this->create('name')->shouldReturnAnInstanceOf('DevBoard\Core\Project\Entity\Project');
    }
}
