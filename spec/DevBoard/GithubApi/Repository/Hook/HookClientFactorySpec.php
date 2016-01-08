<?php
namespace spec\DevBoard\GithubApi\Repository\Hook;

use DevBoard\GithubApi\Repository\Hook\HookSettings;
use Github\Client;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookClientFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubApi\Repository\Hook\HookClientFactory');
    }

    public function let(AuthenticatedClientFactoryInterface $clientFactory, HookSettings $hookSettings)
    {
        $this->beConstructedWith($clientFactory, $hookSettings);
    }

    public function it_will_return_an_instance_of_hook_client(
        $clientFactory,
        GithubRepoDataInterface $githubRepo,
        User $user,
        Client $client
    ) {
        $clientFactory->create($user)->willReturn($client);

        $this->create($githubRepo, $user)->shouldReturnAnInstanceOf('DevBoard\GithubApi\Repository\Hook\HookClient');
    }
}
