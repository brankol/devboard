<?php
namespace spec\DevBoard\Core\CreateProject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccessibleProjectsContainerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\AccessibleProjectsContainer');
    }
}
