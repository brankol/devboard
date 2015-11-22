<?php
namespace spec\DevBoard\Github\User\Mapper;

use DevBoard\Github\User\Entity\GithubUser;
use NullDev\GithubApi\User\GithubUserDataInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubUserDataInterface $remote,
        GithubUser $entity,
        $githubId,
        $username,
        $email,
        $name,
        $avatarUrl

    ) {
        $remote->getGithubId()->willReturn($githubId);
        $remote->getUsername()->willReturn($username);
        $remote->getEmail()->willReturn($email);
        $remote->getName()->willReturn($name);
        $remote->getAvatarUrl()->willReturn($avatarUrl);

        $entity->setGithubId($githubId)->shouldBeCalled();
        $entity->setUsername($username)->shouldBeCalled();
        $entity->setEmail($email)->shouldBeCalled();
        $entity->setName($name)->shouldBeCalled();
        $entity->setAvatarUrl($avatarUrl)->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }

    public function it_will_map_property_values_from_remote_to_entity_even_if_only_username_exists(
        GithubUserDataInterface $remote,
        GithubUser $entity,
        $username

    ) {
        $remote->getGithubId()->willReturn(null);
        $remote->getUsername()->willReturn($username);
        $remote->getEmail()->willReturn(null);
        $remote->getName()->willReturn(null);
        $remote->getAvatarUrl()->willReturn(null);

        $entity->setGithubId(Argument::any())->shouldNotBeCalled();
        $entity->setUsername($username)->shouldBeCalled();
        $entity->setEmail(Argument::any())->shouldNotBeCalled();
        $entity->setName(Argument::any())->shouldNotBeCalled();
        $entity->setAvatarUrl(Argument::any())->shouldNotBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
