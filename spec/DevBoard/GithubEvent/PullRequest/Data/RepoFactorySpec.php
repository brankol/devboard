<?php
namespace spec\DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\Data\RepoFactory');
    }

    public function it_will_create_remote_repo_value_object(PullRequestPayload $pullRequestPayload)
    {
        $data = [
            'id'        => 'githubId',
            'name'      => 'name',
            'full_name' => 'owner/name',
            'owner'     => [
                'login' => 'owner',
            ],
            'html_url'       => 'https://github.com/owner/name',
            'description'    => 'Description',
            'fork'           => false,
            'default_branch' => 'master',
            'private'        => false,
            'git_url'        => 'git://github.com/owner/name.git',
            'ssh_url'        => 'git@github.com:owner/name.git',
            'created_at'     => '2015-10-17T15:53:45Z',
            'updated_at'     => '2015-10-17T15:53:45Z',
            'pushed_at'      => '2015-10-17T15:53:45Z',
        ];

        $pullRequestPayload->getRepositoryDetails()->willReturn($data);

        $this->create($pullRequestPayload)->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Repo\Repo');
    }
}
