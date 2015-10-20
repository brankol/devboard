<?php
namespace spec\DevBoard\Github\Repo;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Repo\GithubRepo');
    }

    public function it_should_allow_access_to_local_github_repo_id()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_holds_remote_github_id()
    {
        $this->setGithubId('12345');
        $this->getGithubId()->shouldReturn('12345');
    }

    public function it_holds_repo_owner_name()
    {
        $this->setOwner('owner');
        $this->getOwner()->shouldReturn('owner');
    }

    public function it_holds_repo_name()
    {
        $this->setName('repo');
        $this->getName()->shouldReturn('repo');
    }

    public function it_holds_repo_full_name()
    {
        $this->setFullName('owner/repo');
        $this->getFullName()->shouldReturn('owner/repo');
    }

    public function it_holds_repo_html_url()
    {
        $this->setHtmlUrl('http://....');
        $this->getHtmlUrl()->shouldReturn('http://....');
    }

    public function it_holds_repo_description()
    {
        $this->setDescription('desc');
        $this->getDescription()->shouldReturn('desc');
    }

    public function it_holds_flag_if_repo_is_a_fork()
    {
        $this->setFork('1');
        $this->getFork()->shouldReturn('1');
    }

    public function it_holds_name_of_default_branch_on_repo()
    {
        $this->setDefaultBranch('master');
        $this->getDefaultBranch()->shouldReturn('master');
    }

    public function it_holds_flag_if_repo_is_private()
    {
        $this->setGithubPrivate('0');
        $this->getGithubPrivate()->shouldReturn('0');
    }

    public function it_holds_datetime_when_was_repo_created_on_github(\DateTime $createdAt)
    {
        $this->setGithubCreatedAt($createdAt);
        $this->getGithubCreatedAt()->shouldReturn($createdAt);
    }

    public function it_holds_datetime_when_was_repo_last_update_on_github(\DateTime $updatedAt)
    {
        $this->setGithubUpdatedAt($updatedAt);
        $this->getGithubUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_holds_datetime_when_was_repo_last_pushed_at_on_github(\DateTime $pushedAt)
    {
        $this->setGithubPushedAt($pushedAt);
        $this->getGithubPushedAt()->shouldReturn($pushedAt);
    }

    public function it_holds_git_url_to_clone_repo()
    {
        $this->setGitUrl('git://gith...');
        $this->getGitUrl()->shouldReturn('git://gith...');
    }

    public function it_holds_ssh_url_to_clone_repo()
    {
        $this->setSshUrl('git@github..');
        $this->getSshUrl()->shouldReturn('git@github..');
    }

    public function it_holds_when_repo_was_created_locally(\DateTime $created)
    {
        $this->setCreatedAt($created);
        $this->getCreatedAt()->shouldReturn($created);
    }

    public function it_holds_when_repo_was_last_updated_locally(\DateTime $updated)
    {
        $this->setUpdatedAt($updated);
        $this->getUpdatedAt()->shouldReturn($updated);
    }

    /**
     * @param DevBoard\Core\Project\Project $project1
     * @param DevBoard\Core\Project\Project $project2
     */
    public function it_supports_that_one_repo_can_be_used_in_multiple_projects($project1, $project2)
    {
        $this->addProject($project1);
        $this->addProject($project2);
        $this->getProjects()->count()->shouldReturn(2);
    }

    public function it_supports_setting_and_getting_collection_of_projects(ArrayCollection $collection)
    {
        $this->setProjects($collection);
        $this->getProjects()->shouldReturn($collection);
        $this->getProjects()->shouldReturnAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    /**
     * @param DevBoard\Github\Branch\GithubBranch $branch1
     * @param DevBoard\Github\Branch\GithubBranch $branch2
     */
    public function it_supports_that_one_repo_will_have_multiple_branches($branch1, $branch2)
    {
        $this->addBranch($branch1);
        $this->addBranch($branch2);
        $this->getBranches()->count()->shouldReturn(2);
    }

    public function it_supports_setting_and_getting_collection_of_branches(ArrayCollection $collection)
    {
        $this->setBranches($collection);
        $this->getBranches()->shouldReturn($collection);
        $this->getBranches()->shouldReturnAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    public function it_is_convertable_to_string()
    {
        $this->setFullName('owner/repo');
        $this->__toString()->shouldReturn('owner/repo');
    }

    /**
     * @param DevBoard\Github\Branch\GithubBranch         $masterBranch
     * @param DevBoard\Github\Branch\GithubBranch         $devBranch
     * @param Doctrine\Common\Collections\ArrayCollection $collection
     */
    public function it_can_return_branch_if_exists_on_repo($masterBranch, $devBranch, $collection)
    {
        $masterBranch->getName()->willReturn('master')->shouldBeCalled();
        $devBranch->getName()->willReturn('dev')->shouldBeCalled();

        $collection->getIterator()->willReturn(
            new \ArrayIterator(
                [
                    $masterBranch->getWrappedObject(),
                    $devBranch->getWrappedObject(),
                ]
            )

        );
        $this->setBranches($collection);

        $this->getBranchByName('dev')->shouldReturn($devBranch);
    }

    /**
     * @param Doctrine\Common\Collections\ArrayCollection $collection
     */
    public function it_will_return_null_if_no_branch_with_name_exists_on_repo($collection)
    {
        $collection->getIterator()->willReturn(new \ArrayIterator([]));

        $this->setBranches($collection);

        $this->getBranchByName('dev')->shouldReturn(null);
    }
    public function it_sets_created_and_updated_datetimes_when_creating_github_repo()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_github_repo_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_will_return_name_as_default_string($name = 'owner/repo')
    {
        $this->setFullName($name);
        $this->__toString()->shouldReturn($name);
    }
}
