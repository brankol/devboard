<?php
namespace spec\NullDev\GithubApi\Branch;

use Github\Api\Repo as RepoApi;
use Github\Client;
use NullDev\GithubApi\Branch\GithubBranchData;
use NullDev\GithubApi\Branch\GithubBranchDataFactory;
use NullDev\GithubApi\Branch\GithubBranchDataInterface;
use NullDev\GithubApi\Client\Authenticated\AuthenticatedClientFactoryInterface;
use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use NullDev\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteGithubBranchServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Branch\RemoteGithubBranchService');
    }

    public function let(
        AuthenticatedClientFactoryInterface $authenticatedClientFactory,
        GithubBranchDataFactory $githubBranchDataFactory
    ) {
        $this->beConstructedWith($authenticatedClientFactory, $githubBranchDataFactory);
    }

    public function it_will_fetch_branch_details_from_github(
        $authenticatedClientFactory,
        $githubBranchDataFactory,
        GithubRepoDataInterface $githubRepo,
        GithubBranchDataInterface $githubBranch,
        User $user,
        Client $client,
        RepoApi $repoApi,
        GithubBranchData $githubBranchData
    ) {
        $githubRepo->getOwner()->willReturn('owner');
        $githubRepo->getName()->willReturn('name');
        $githubBranch->getName()->willReturn('master');

        $authenticatedClientFactory->create($user)->willReturn($client);

        $client->api('repository')->willReturn($repoApi);

        $repoApi->branches('owner', 'name', 'master')->willReturn(['data']);

        $githubBranchDataFactory->create(['data'])->willReturn($githubBranchData);

        $this->fetch($githubRepo, $githubBranch, $user)->shouldReturn($githubBranchData);
    }

    public function it_will_fetch_all_branches_from_github(
        $authenticatedClientFactory,
        $githubBranchDataFactory,
        GithubRepoDataInterface $githubRepo,
        User $user,
        Client $client,
        RepoApi $repoApi,
        GithubBranchData $githubBranchData
    ) {
        $githubRepo->getOwner()->willReturn('owner');
        $githubRepo->getName()->willReturn('name');

        $authenticatedClientFactory->create($user)->willReturn($client);

        $client->api('repository')->willReturn($repoApi);

        $repoApi->branches('owner', 'name')->willReturn([['name' => 'master']]);
        $repoApi->branches('owner', 'name', 'master')->willReturn(['data']);

        $githubBranchDataFactory->create(['data'])->willReturn($githubBranchData);

        $this->fetchAll($githubRepo, $user)->shouldReturn([$githubBranchData]);
    }
}
