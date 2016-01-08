<?php
namespace spec\DevBoard\GithubApi\Repository\Hook;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubApi\Repository\Hook\HookSettings;
use Github\Api\Repo;
use Github\Api\Repository\Hooks;
use Github\Client;
use Github\Exception\ValidationFailedException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookClientSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubApi\Repository\Hook\HookClient');
    }

    public function let(Client $client, HookSettings $hookSettings, GithubRepo $githubRepo, Repo $repo, Hooks $hooks)
    {
        $githubRepo->getOwner()->willReturn('owner');
        $githubRepo->getName()->willReturn('repository');

        $client->repo()->willReturn($repo);
        $repo->hooks()->willReturn($hooks);
        $hookSettings->getCreateHookParams()->willReturn(['params']);

        $this->beConstructedWith($client, $hookSettings, $githubRepo);
    }

    public function it_will_create_new_hook($hooks)
    {
        $hooks->create('owner', 'repository', ['params'])->willReturn(['data']);

        $this->createHook()->shouldReturn(['data']);
    }

    public function it_will_return_false_if_hook_exists($hooks)
    {
        $exception = new ValidationFailedException();

        $hooks->create('owner', 'repository', ['params'])->willThrow($exception);

        $this->createHook()->shouldReturn($exception);
    }
}
