<?php
namespace spec\DevBoard\Github\Hook\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubHookFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Hook\Entity\GithubHookFactory');
    }

    public function it_will_create_instance_using_repo(
        $mapper,
        GithubRepo $githubRepo
    ) {
        $result = $this->create($githubRepo);

        $result->shouldReturnAnInstanceOf('DevBoard\Github\Hook\Entity\GithubHook');
    }
}
