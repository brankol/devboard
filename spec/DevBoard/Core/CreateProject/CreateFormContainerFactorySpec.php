<?php
namespace spec\DevBoard\Core\CreateProject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;

class CreateFormContainerFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\CreateFormContainerFactory');
    }

    public function let(FormFactory $formFactory, Router $router)
    {
        $this->beConstructedWith($formFactory, $router);
    }
}
