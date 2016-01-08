<?php
namespace spec\DevBoard\GithubApi\Repository\Hook;

use DevBoard\GithubApi\Repository\Hook\HookSettings;
use Github\Client;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;
use NullDev\UserBundle\Service\CurrentUserService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurrentUserHookClientFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubApi\Repository\Hook\CurrentUserHookClientFactory');
    }

    public function let(
        AuthenticatedClientFactoryInterface $clientFactory,
        HookSettings $hookSettings,
        CurrentUserService $currentUserService
    ) {
        $this->beConstructedWith($clientFactory, $hookSettings, $currentUserService);
    }

    public function it_will_return_an_instance_of_hook_client(
        $clientFactory,
        GithubRepoDataInterface $githubRepo,
        User $user,
        Client $client,
        $currentUserService
    ) {
        $currentUserService->getUser()->willReturn($user);
        $clientFactory->create($user)->willReturn($client);

        $this->create($githubRepo)->shouldReturnAnInstanceOf('DevBoard\GithubApi\Repository\Hook\HookClient');
    }
}
