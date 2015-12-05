<?php
namespace spec\DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\Data\RepoFactory');
    }

    public function it_will_create_remote_repo_value_object(PushPayload $pushPayload)
    {
        $data = [
            'id'        => 'githubId',
            'name'      => 'name',
            'full_name' => 'owner/name',
            'owner'     => [
                'name' => 'owner',
            ],
            'html_url'       => 'https://github.com/owner/name',
            'description'    => 'Description',
            'fork'           => false,
            'default_branch' => 'master',
            'private'        => false,
            'git_url'        => 'git://github.com/owner/name.git',
            'ssh_url'        => 'git@github.com:owner/name.git',
            'created_at'     => 1445097225,
            'updated_at'     => '2015-10-17T15:53:45Z',
            'pushed_at'      => 1448054741,
        ];

        $pushPayload->getRepositoryDetails()->willReturn($data);

        $this->create($pushPayload)->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Repo\Repo');
    }
}
