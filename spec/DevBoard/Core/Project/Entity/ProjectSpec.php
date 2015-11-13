<?php
namespace spec\DevBoard\Core\Project\Entity;

use DevBoard\Github\Repo\GithubRepo;
use Doctrine\Common\Collections\ArrayCollection;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProjectSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Core\Project\Entity\Project');
    }

    public function it_should_allow_access_to_project_id()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_holds_project_name()
    {
        $this->setProjectName('owner/repo');
        $this->getProjectName()->shouldReturn('owner/repo');
    }

    public function it_has_flag_describing_if_project_is_active_or_not()
    {
        $this->setActive(1);
        $this->getActive()->shouldReturn(1);
    }

    public function it_supports_collection_of_github_repos()
    {
        $this->getGithubRepos()->shouldReturnAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    public function it_supports_setting_and_getting_collection_of_github_repos(ArrayCollection $collection)
    {
        $this->setGithubRepos($collection);
        $this->getGithubRepos()->shouldReturn($collection);
        $this->getGithubRepos()->shouldReturnAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    /**
     * @param DevBoard\Github\Repo\GithubRepo $githubRepo1
     * @param DevBoard\Github\Repo\GithubRepo $githubRepo2
     */
    public function it_supports_that_one_project_can_have_more_github_repos($githubRepo1, $githubRepo2)
    {
        $this->addGithubRepo($githubRepo1);
        $this->addGithubRepo($githubRepo2);
        $this->getGithubRepos()->count()->shouldReturn(2);
    }

    /**
     * @param DevBoard\Github\Repo\GithubRepo             $githubRepo1
     * @param DevBoard\Github\Repo\GithubRepo             $githubRepo2
     * @param Doctrine\Common\Collections\ArrayCollection $collection
     */
    public function it_will_overwrite_exiting_github_repos_when_setting_new_ones(
        $githubRepo1,
        $githubRepo2,
        $collection
    ) {
        $this->addGithubRepo($githubRepo1);
        $this->getGithubRepos()->count()->shouldReturn(1);

        $collection->add($githubRepo2);

        $this->setGithubRepos($collection);
        $this->getGithubRepos()->shouldReturn($collection);
    }

    public function it_can_only_have_one_user_per_project(User $user)
    {
        $this->setUser($user);
        $this->getUser()->shouldReturn($user);
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

    public function it_sets_created_and_updated_datetimes_when_creating_project()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_project_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_will_return_name_as_default_string($name = 'owner/repo')
    {
        $this->setProjectName($name);
        $this->__toString()->shouldReturn($name);
    }
}
