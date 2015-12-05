<?php
namespace spec\DevBoard\Github\Tag\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Tag\Mapper\RemoteToEntityMapper;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubTagFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Tag\Entity\GithubTagFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_value_object(
        $mapper,
        GithubRepo $githubRepo,
        Tag $tagValueObject
    ) {
        $result = $this->createFromValueObject($githubRepo, $tagValueObject);

        $mapper->map($tagValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\Tag\Entity\GithubTag');
    }
}
