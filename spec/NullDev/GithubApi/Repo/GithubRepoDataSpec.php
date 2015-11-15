<?php
namespace spec\NullDev\GithubApi\Repo;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Repo\GithubRepoData');
    }

    public function let(
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
        $this->beConstructedWith(
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
            $githubCreatedAt,
            $githubUpdatedAt,
            $githubPushedAt
        );
    }

    public function it_exposes_all_constructor_params_via_getters(
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
        $githubCreatedAt,
        $githubUpdatedAt,
        $githubPushedAt
    ) {
        $this->getGithubId()->shouldReturn($githubId);
        $this->getOwner()->shouldReturn($owner);
        $this->getName()->shouldReturn($name);
        $this->getFullName()->shouldReturn($fullName);
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
        $this->getDescription()->shouldReturn($description);
        $this->getFork()->shouldReturn($fork);
        $this->getDefaultBranch()->shouldReturn($defaultBranch);
        $this->getGithubPrivate()->shouldReturn($githubPrivate);
        $this->getGitUrl()->shouldReturn($gitUrl);
        $this->getSshUrl()->shouldReturn($sshUrl);
        $this->getGithubCreatedAt()->shouldReturn($githubCreatedAt);
        $this->getGithubUpdatedAt()->shouldReturn($githubUpdatedAt);
        $this->getGithubPushedAt()->shouldReturn($githubPushedAt);
    }
}
