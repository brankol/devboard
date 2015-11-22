<?php
namespace spec\DevBoard\GithubRemote\ValueObject\Repo;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\ValueObject\Repo\Repo');
    }

    public function let(DateTime $githubCreatedAt, DateTime $githubUpdatedAt, DateTime $githubPushedAt)
    {
        $this->beConstructedWith(
            'githubId',
            'owner',
            'name',
            'owner/name',
            'https://github.com/owner/name',
            'Description',
            false,
            'master',
            false,
            'git://github.com/owner/name.git',
            'git@github.com:owner/name.git',
            $githubCreatedAt,
            $githubUpdatedAt,
            $githubPushedAt
        );
    }

    public function it_holds_remote_github_id()
    {
        $this->getGithubId()->shouldReturn('githubId');
    }

    public function it_holds_repo_owner_name()
    {
        $this->getOwner()->shouldReturn('owner');
    }

    public function it_holds_repo_name()
    {
        $this->getName()->shouldReturn('name');
    }

    public function it_holds_repo_full_name()
    {
        $this->getFullName()->shouldReturn('owner/name');
    }

    public function it_holds_repo_html_url()
    {
        $this->getHtmlUrl()->shouldReturn('https://github.com/owner/name');
    }

    public function it_holds_repo_description()
    {
        $this->getDescription()->shouldReturn('Description');
    }

    public function it_holds_flag_if_repo_is_a_fork()
    {
        $this->getFork()->shouldReturn(false);
    }

    public function it_holds_name_of_default_branch_on_repo()
    {
        $this->getDefaultBranch()->shouldReturn('master');
    }

    public function it_holds_flag_if_repo_is_private()
    {
        $this->getGithubPrivate()->shouldReturn(false);
    }

    public function it_holds_datetime_when_was_repo_created_on_github(\DateTime $githubCreatedAt)
    {
        $this->getGithubCreatedAt()->shouldReturn($githubCreatedAt);
    }

    public function it_holds_datetime_when_was_repo_last_update_on_github(\DateTime $githubUpdatedAt)
    {
        $this->getGithubUpdatedAt()->shouldReturn($githubUpdatedAt);
    }

    public function it_holds_datetime_when_was_repo_last_pushed_at_on_github(\DateTime $githubPushedAt)
    {
        $this->getGithubPushedAt()->shouldReturn($githubPushedAt);
    }

    public function it_holds_git_url_to_clone_repo()
    {
        $this->getGitUrl()->shouldReturn('git://github.com/owner/name.git');
    }

    public function it_holds_ssh_url_to_clone_repo()
    {
        $this->getSshUrl()->shouldReturn('git@github.com:owner/name.git');
    }
}
