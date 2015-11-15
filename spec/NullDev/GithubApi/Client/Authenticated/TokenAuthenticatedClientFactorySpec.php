<?php
namespace spec\NullDev\GithubApi\Client\Authenticated;

use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenAuthenticatedClientFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Client\Authenticated\TokenAuthenticatedClientFactory');
    }

    public function it_will_return_instance_of_github_client_authorized_with_user_credentials(User $user)
    {
        $this->create($user)->shouldReturnAnInstanceOf('Github\Client');
    }
}
