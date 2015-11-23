<?php
namespace spec\NullDev\GithubApi\Commit;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Github\Api\Repo;
use Github\Api\Repository\Commits;
use Github\Client;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Commit\GithubCommitData;
use NullDev\GithubApi\Commit\GithubCommitDataFactory;
use NullDev\GithubApi\Commit\GithubCommitDataInterface;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteGithubCommitServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Commit\RemoteGithubCommitService');
    }

    public function let(
        AuthenticatedClientFactoryInterface $authenticatedClientFactory,
        GithubCommitDataFactory $githubCommitDataFactory
    ) {
        $this->beConstructedWith($authenticatedClientFactory, $githubCommitDataFactory);
    }

    public function it_will_fetch_commit_details_from_github(
        $authenticatedClientFactory,
        $githubCommitDataFactory,
        GithubCommitDataInterface $githubCommit,
        GithubRepo $githubRepo,
        User $user,
        Client $client,
        Repo $repositoryApi,
        Commits $commitApi,
        GithubCommitData $githubCommitData
    ) {
        $githubRepo->getOwner()->willReturn('owner');
        $githubRepo->getName()->willReturn('name');
        $githubCommit->getSha()->willReturn('sha');

        $authenticatedClientFactory->create($user)->willReturn($client);

        $client->api('repository')->willReturn($repositoryApi);
        $repositoryApi->commits()->willReturn($commitApi);

        $commitApi->show('owner', 'name', 'sha')->willReturn(['data']);

        $githubCommitDataFactory->create($githubRepo, ['data'])->willReturn($githubCommitData);

        $this->fetch($githubCommit, $githubRepo, $user)->shouldReturn($githubCommitData);
    }
}
