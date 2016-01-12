<?php
namespace spec\DevBoard\Core\CreateProject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositoryCollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\RepositoryCollection');
        $this->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }
}
