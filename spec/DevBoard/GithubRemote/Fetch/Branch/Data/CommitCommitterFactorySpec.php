<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch\Data;

use NullDev\GithubApi\Branch\GithubBranchData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitCommitterFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\Data\CommitCommitterFactory');
    }
    public function it_will_create_remote_commit_committer_value_object(GithubBranchData $githubBranchData)
    {
        $data = [
            'commit' => [
                'author' => [
                    'name'  => 'author1',
                    'email' => 'author1@users.noreply.github.com',
                    'date'  => '2015-08-21T19:25:38Z',
                ],
                'committer' => [
                    'name'  => 'author1',
                    'email' => 'author1@users.noreply.github.com',
                    'date'  => '2015-08-21T19:25:38Z',
                ],
            ],
            'author' => [
                'login'      => 'author1',
                'id'         => 123,
                'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
            ],
            'committer' => [
                'login'      => 'author1',
                'id'         => 123,
                'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
            ],
        ];

        $githubBranchData->getCommitData()->willReturn($data);

        $result = $this->create($githubBranchData);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\User\CommitCommitter');
        $result->getName()->shouldReturn('author1');
        $result->getEmail()->shouldReturn('author1@users.noreply.github.com');
        $result->getUsername()->shouldReturn('author1');
    }
}
