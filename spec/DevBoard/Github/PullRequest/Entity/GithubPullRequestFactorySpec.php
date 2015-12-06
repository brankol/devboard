<?php
namespace spec\DevBoard\Github\PullRequest\Entity;

use DevBoard\Github\PullRequest\Mapper\RemoteToEntityMapper;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\Entity\GithubPullRequestFactory');
    }

    public function let(RemoteToEntityMapper $mapper)
    {
        $this->beConstructedWith($mapper);
    }

    public function it_will_create_instance_using_value_object(
        $mapper,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject
    ) {
        $result = $this->createFromValueObject($githubRepo, $pullRequestValueObject);

        $mapper->map($pullRequestValueObject, Argument::any())->shouldBeCalled();

        $result->shouldReturnAnInstanceOf('DevBoard\Github\PullRequest\Entity\GithubPullRequest');
    }
}
