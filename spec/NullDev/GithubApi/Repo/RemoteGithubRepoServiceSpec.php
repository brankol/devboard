<?php
namespace spec\NullDev\GithubApi\Repo;

use Github\Api\Repo;
use Github\Client;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteGithubRepoServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Repo\RemoteGithubRepoService');
    }

    public function let(AuthenticatedClientFactoryInterface $authenticatedClientFactory)
    {
        $this->beConstructedWith($authenticatedClientFactory);
    }

    public function it_will_fetch_repo_details_from_github(
        $authenticatedClientFactory,
        GithubRepoDataInterface $githubRepo,
        User $user,
        Client $client,
        Repo $repoApi
    ) {
        $githubRepo->getOwner()->willReturn('owner');
        $githubRepo->getName()->willReturn('name');

        $authenticatedClientFactory->create($user)->willReturn($client);

        $client->api('repository')->willReturn($repoApi);

        $repoApi->show('owner', 'name')->willReturn(['data']);

        $this->fetch($githubRepo, $user)->shouldReturn(['data']);
    }
}
