<?php
namespace spec\DevBoard\Github\Repo\Mapper;

use DateTime;
use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\Repo\GithubRepoData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteToEntityMapperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\Mapper\RemoteToEntityMapper');
    }

    public function it_will_map_property_values_from_remote_to_entity(
        GithubRepoData $remote,
        GithubRepo $entity,
        $githubId,
        $owner,
        $name,
        $fullName,
        $htmlUrl,
        $description,
        $fork,
        $defaultBranch,
        $githubPrivate,
        $gitUrl,
        $sshUrl,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt,
        DateTime $githubPushedAt
    ) {
        $remote->getGithubId()->willReturn($githubId);
        $remote->getOwner()->willReturn($owner);
        $remote->getName()->willReturn($name);
        $remote->getFullName()->willReturn($fullName);
        $remote->getHtmlUrl()->willReturn($htmlUrl);
        $remote->getDescription()->willReturn($description);
        $remote->getFork()->willReturn($fork);
        $remote->getDefaultBranch()->willReturn($defaultBranch);
        $remote->getGithubPrivate()->willReturn($githubPrivate);
        $remote->getGitUrl()->willReturn($gitUrl);
        $remote->getSshUrl()->willReturn($sshUrl);
        $remote->getGithubCreatedAt()->willReturn($githubCreatedAt);
        $remote->getGithubUpdatedAt()->willReturn($githubUpdatedAt);
        $remote->getGithubPushedAt()->willReturn($githubPushedAt);

        $entity->setGithubId($githubId)->shouldBeCalled();
        $entity->setOwner($owner)->shouldBeCalled();
        $entity->setName($name)->shouldBeCalled();
        $entity->setFullName($fullName)->shouldBeCalled();
        $entity->setHtmlUrl($htmlUrl)->shouldBeCalled();
        $entity->setDescription($description)->shouldBeCalled();
        $entity->setFork($fork)->shouldBeCalled();
        $entity->setDefaultBranch($defaultBranch)->shouldBeCalled();
        $entity->setGithubPrivate($githubPrivate)->shouldBeCalled();
        $entity->setGitUrl($gitUrl)->shouldBeCalled();
        $entity->setSshUrl($sshUrl)->shouldBeCalled();
        $entity->setGithubCreatedAt($githubCreatedAt)->shouldBeCalled();
        $entity->setGithubUpdatedAt($githubUpdatedAt)->shouldBeCalled();
        $entity->setGithubPushedAt($githubPushedAt)->shouldBeCalled();

        $this->map($remote, $entity)->shouldReturn(true);
    }
}
