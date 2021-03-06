<?php
namespace spec\DevBoard\Github\Tag\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Repo\Entity\GithubRepo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubTagSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Tag\Entity\GithubTag');
    }

    public function it_should_allow_access_to_local_tag_id()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_holds_a_reference_to_repo_it_belongs_to(GithubRepo $repo)
    {
        $this->setRepo($repo);
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_holds_tag_name()
    {
        $this->setName('master');
        $this->getName()->shouldReturn('master');
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
    public function it_sets_created_and_updated_datetimes_when_creating_github_tag()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_github_tag_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_will_return_name_as_default_string($name = 'master')
    {
        $this->setName($name);
        $this->__toString()->shouldReturn($name);
    }
}
