<?php
namespace spec\NullDev\GithubApi\Branch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubBranchDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Branch\GithubBranchDataFactory');
    }

    public function it_will_create_new_instance_using_array_from_github()
    {
        $arr = [
            'name'   => 'master',
            'commit' => [
                'sha'    => 'db911bd3a3dd8bb2ad9eccbcb0a396595a51491d',
                'commit' => [
                    'author' => [
                        'name'  => 'devboard-john',
                        'email' => 'devboard-john@users.noreply.github.com',
                        'date'  => '2015-08-21T19:25:38Z',
                    ],
                    'committer' => [
                        'name'  => 'devboard-john',
                        'email' => 'devboard-john@users.noreply.github.com',
                        'date'  => '2015-08-21T19:25:38Z',
                    ],
                    'message' => 'Initial commit',
                    'tree'    => [
                        'sha' => 'a8129e3b24dc36c1b001d53d776ee8c1ad5bf1bf',
                        'url' => 'https://api.github.com/repos/devboard/test-hitman/git/trees/a8129e3b24dc36c1b001d53d776ee8c1ad5bf1bf',
                    ],
                    'url'           => 'https://api.github.com/repos/devboard/test-hitman/git/commits/db911bd3a3dd8bb2ad9eccbcb0a396595a51491d',
                    'comment_count' => 0,
                ],
                'url'          => 'https://api.github.com/repos/devboard/test-hitman/commits/db911bd3a3dd8bb2ad9eccbcb0a396595a51491d',
                'html_url'     => 'https://github.com/devboard/test-hitman/commit/db911bd3a3dd8bb2ad9eccbcb0a396595a51491d',
                'comments_url' => 'https://api.github.com/repos/devboard/test-hitman/commits/db911bd3a3dd8bb2ad9eccbcb0a396595a51491d/comments',
                'author'       => [
                    'login'               => 'devboard-john',
                    'id'                  => 13906273,
                    'avatar_url'          => 'https://avatars.githubusercontent.com/u/13906273?v=3',
                    'gravatar_id'         => '',
                    'url'                 => 'https://api.github.com/users/devboard-john',
                    'html_url'            => 'https://github.com/devboard-john',
                    'followers_url'       => 'https://api.github.com/users/devboard-john/followers',
                    'following_url'       => 'https://api.github.com/users/devboard-john/following{/other_user}',
                    'gists_url'           => 'https://api.github.com/users/devboard-john/gists{/gist_id}',
                    'starred_url'         => 'https://api.github.com/users/devboard-john/starred{/owner}{/repo}',
                    'subscriptions_url'   => 'https://api.github.com/users/devboard-john/subscriptions',
                    'organizations_url'   => 'https://api.github.com/users/devboard-john/orgs',
                    'repos_url'           => 'https://api.github.com/users/devboard-john/repos',
                    'events_url'          => 'https://api.github.com/users/devboard-john/events{/privacy}',
                    'received_events_url' => 'https://api.github.com/users/devboard-john/received_events',
                    'type'                => 'User',
                    'site_admin'          => false,
                ],
                'committer' => [
                    'login'               => 'devboard-john',
                    'id'                  => 13906273,
                    'avatar_url'          => 'https://avatars.githubusercontent.com/u/13906273?v=3',
                    'gravatar_id'         => '',
                    'url'                 => 'https://api.github.com/users/devboard-john',
                    'html_url'            => 'https://github.com/devboard-john',
                    'followers_url'       => 'https://api.github.com/users/devboard-john/followers',
                    'following_url'       => 'https://api.github.com/users/devboard-john/following{/other_user}',
                    'gists_url'           => 'https://api.github.com/users/devboard-john/gists{/gist_id}',
                    'starred_url'         => 'https://api.github.com/users/devboard-john/starred{/owner}{/repo}',
                    'subscriptions_url'   => 'https://api.github.com/users/devboard-john/subscriptions',
                    'organizations_url'   => 'https://api.github.com/users/devboard-john/orgs',
                    'repos_url'           => 'https://api.github.com/users/devboard-john/repos',
                    'events_url'          => 'https://api.github.com/users/devboard-john/events{/privacy}',
                    'received_events_url' => 'https://api.github.com/users/devboard-john/received_events',
                    'type'                => 'User',
                    'site_admin'          => false,
                ],
                'parents' => [],
            ],
            '_links' => [
                'self' => 'https://api.github.com/repos/devboard/test-hitman/branches/master',
                'html' => 'https://github.com/devboard/test-hitman/tree/master',
            ],
        ];
        $result = $this->create($arr);

        $result->shouldBeAnInstanceOf('NullDev\GithubApi\Branch\GithubBranchData');
    }
}
