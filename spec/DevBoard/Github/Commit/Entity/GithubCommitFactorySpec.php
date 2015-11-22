<?php
namespace spec\DevBoard\Github\Commit\Entity;

use DevBoard\Github\Commit\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\Entity\GithubCommitFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_value_object(
        $mapper,
        GithubRepo $githubRepo,
        Commit $commitValueObject
    ) {
        $result = $this->createFromValueObject($githubRepo, $commitValueObject);

        $mapper->map($commitValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\Commit\Entity\GithubCommit');
    }
}
