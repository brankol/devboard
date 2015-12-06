<?php
namespace spec\DevBoard\Github\PullRequest\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\Entity\GithubUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\Entity\GithubPullRequest');
    }

    public function it_should_allow_access_to_local_pullRequest_id()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_holds_a_reference_to_repo_it_belongs_to(GithubRepo $repo)
    {
        $this->setRepo($repo);
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_holds_pull_request_number()
    {
        $this->setNumber(22);
        $this->getNumber()->shouldReturn(22);
    }

    public function it_holds_pull_request_title()
    {
        $this->setTitle('master');
        $this->getTitle()->shouldReturn('master');
    }

    public function it_holds_pull_request_body()
    {
        $this->setBody('body');
        $this->getBody()->shouldReturn('body');
    }

    public function it_holds_pull_request_state()
    {
        $this->setState(10);
        $this->getState()->shouldReturn(10);
    }

    public function it_knows_if_pull_request_locked()
    {
        $this->setLocked(true);
        $this->isLocked()->shouldReturn(true);
    }

    public function it_knows_if_pull_request_merged()
    {
        $this->setMerged(false);
        $this->isMerged()->shouldReturn(false);
    }

    public function it_holds_pull_request_creator(GithubUser $createdBy)
    {
        $this->setCreatedBy($createdBy);
        $this->getCreatedBy()->shouldReturn($createdBy);
    }

    public function it_holds_pull_request_assignee(GithubUser $assignee)
    {
        $this->setAssignedTo($assignee);
        $this->getAssignedTo()->shouldReturn($assignee);
    }

    public function it_has_last_commit_as_a_reference(GithubCommit $githubCommit)
    {
        $this->setLastCommit($githubCommit);
        $this->getLastCommit()->shouldReturn($githubCommit);
    }

    public function it_holds_when_project_was_created(\DateTime $created)
    {
        $this->setCreatedAt($created);
        $this->getCreatedAt()->shouldReturn($created);
    }

    public function it_holds_when_project_was_last_updated(\DateTime $updated)
    {
        $this->setUpdatedAt($updated);
        $this->getUpdatedAt()->shouldReturn($updated);
    }

    public function it_sets_created_and_updated_datetimes_when_creating_github_pullRequest()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_github_pullRequest_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_holds_datetime_when_was_pull_request_created_on_github(\DateTime $createdAt)
    {
        $this->setGithubCreatedAt($createdAt);
        $this->getGithubCreatedAt()->shouldReturn($createdAt);
    }

    public function it_holds_datetime_when_was_pull_request_last_update_on_github(\DateTime $updatedAt)
    {
        $this->setGithubUpdatedAt($updatedAt);
        $this->getGithubUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_will_return_title_as_default_string($title = 'master')
    {
        $this->setTitle($title);
        $this->__toString()->shouldReturn($title);
    }
}
