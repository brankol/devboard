<?php
namespace spec\NullDev\GithubApi\User;

use Github\Api\User as ApiUser;
use Github\Client;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\User\GithubUserData;
use NullDev\GithubApi\User\GithubUserDataFactory;
use NullDev\GithubApi\User\GithubUserDataInterface;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteGithubUserServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\User\RemoteGithubUserService');
    }

    public function let(
        AuthenticatedClientFactoryInterface $authenticatedClientFactory,
        GithubUserDataFactory $githubUserDataFactory
    ) {
        $this->beConstructedWith($authenticatedClientFactory, $githubUserDataFactory);
    }

    public function it_will_fetch_user_details_from_github(
        $authenticatedClientFactory,
        $githubUserDataFactory,
        GithubUserDataInterface $githubUser,
        User $user,
        Client $client,
        ApiUser $userApi,
        GithubUserData $githubUserData
    ) {
        $githubUser->getUsername()->willReturn('username');

        $authenticatedClientFactory->create($user)->willReturn($client);

        $client->api('user')->willReturn($userApi);

        $userApi->show('username')->willReturn(['data']);

        $githubUserDataFactory->create(['data'])->willReturn($githubUserData);

        $this->fetch($githubUser, $user)->shouldReturn($githubUserData);
    }
}
