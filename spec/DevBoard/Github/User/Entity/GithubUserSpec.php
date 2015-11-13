<?php
namespace spec\DevBoard\Github\User\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\User\Entity\GithubUser');
    }

    public function it_has_local_id()
    {
        $this->getId();
    }

    public function it_has_github_user_id()
    {
        $this->setGithubId('github-id');

        $this->getGithubId()->shouldReturn('github-id');
    }

    public function it_has_github_user_login()
    {
        $this->setUsername('username');
        $this->getUsername()->shouldReturn('username');
    }

    public function it_has_email_used_on_github()
    {
        $this->setEmail('email@email.com');
        $this->getEmail()->shouldReturn('email@email.com');
    }

    public function it_has_users_first_and_last_name()
    {
        $this->setName('John Smith');
        $this->getName()->shouldReturn('John Smith');
    }

    public function it_has_url_to_users_avatar()
    {
        $this->setAvatarUrl('http://avatar');
        $this->getAvatarUrl()->shouldReturn('http://avatar');
    }

    public function it_holds_when_user_was_created_localy(\DateTime $created)
    {
        $this->setCreatedAt($created);
        $this->getCreatedAt()->shouldReturn($created);
    }

    public function it_holds_when_user_was_last_updated_localy(\DateTime $updated)
    {
        $this->setUpdatedAt($updated);
        $this->getUpdatedAt()->shouldReturn($updated);
    }

    public function it_sets_created_and_updated_datetimes_when_creating_github_user()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_github_user_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_will_return_name_as_default_string($name = 'First Last Name')
    {
        $this->setName($name);
        $this->__toString()->shouldReturn($name);
    }
}
