<?php
namespace spec\NullDev\GithubApi\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\User\GithubUserDataFactory');
    }

    public function it_will_create_new_instance_using_array_from_github()
    {
        $arr = [
            'name'  => 'John Doe',
            'email' => 'john@example.com',
            'login' => 'username',
        ];

        $this->create($arr)->shouldReturnAnInstanceOf('NullDev\GithubApi\User\GithubUserData');
    }

    public function it_will_create_new_instance_using_array_from_github_commit()
    {
        $arr = [
            'login' => 'username',
            'id'    => 123,
        ];

        $this->create($arr)->shouldReturnAnInstanceOf('NullDev\GithubApi\User\GithubUserData');
    }
}
