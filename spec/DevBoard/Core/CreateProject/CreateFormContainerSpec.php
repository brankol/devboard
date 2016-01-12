<?php
namespace spec\DevBoard\Core\CreateProject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\Form;

class CreateFormContainerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\CreateProject\CreateFormContainer');
    }

    public function let(Form $form)
    {
        $this->beConstructedWith($form);
    }
}
