<?php
namespace spec\NullDev\UserBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SecurityControllerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\UserBundle\Controller\SecurityController');
    }
}
