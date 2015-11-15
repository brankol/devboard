<?php
namespace spec\NullDev\GithubApi\Repo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Repo\GithubRepoDataFactory');
    }

    public function it_will_create_new_instance_using_array_from_github()
    {
        $arr = [
            'id'        => 41173477,
            'name'      => 'test-hitman',
            'full_name' => 'devboard/test-hitman',
            'owner'     => [
                'login' => 'devboard',
            ],
            'private'           => false,
            'html_url'          => 'https://github.com/devboard/test-hitman',
            'description'       => 'This is Hitman test repo',
            'fork'              => false,
            'url'               => 'https://api.github.com/repos/devboard/test-hitman',
            'forks_url'         => 'https://api.github.com/repos/devboard/test-hitman/forks',
            'keys_url'          => 'https://api.github.com/repos/devboard/test-hitman/keys{/key_id}',
            'collaborators_url' => 'https://api.github.com/repos/devboard/test-hitman/collaborators{/collaborator}',
            'teams_url'         => 'https://api.github.com/repos/devboard/test-hitman/teams',
            'hooks_url'         => 'https://api.github.com/repos/devboard/test-hitman/hooks',
            'issue_events_url'  => 'https://api.github.com/repos/devboard/test-hitman/issues/events{/number}',
            'events_url'        => 'https://api.github.com/repos/devboard/test-hitman/events',
            'assignees_url'     => 'https://api.github.com/repos/devboard/test-hitman/assignees{/user}',
            'branches_url'      => 'https://api.github.com/repos/devboard/test-hitman/branches{/branch}',
            'tags_url'          => 'https://api.github.com/repos/devboard/test-hitman/tags',
            'blobs_url'         => 'https://api.github.com/repos/devboard/test-hitman/git/blobs{/sha}',
            'git_tags_url'      => 'https://api.github.com/repos/devboard/test-hitman/git/tags{/sha}',
            'git_refs_url'      => 'https://api.github.com/repos/devboard/test-hitman/git/refs{/sha}',
            'trees_url'         => 'https://api.github.com/repos/devboard/test-hitman/git/trees{/sha}',
            'statuses_url'      => 'https://api.github.com/repos/devboard/test-hitman/statuses/{sha}',
            'languages_url'     => 'https://api.github.com/repos/devboard/test-hitman/languages',
            'stargazers_url'    => 'https://api.github.com/repos/devboard/test-hitman/stargazers',
            'contributors_url'  => 'https://api.github.com/repos/devboard/test-hitman/contributors',
            'subscribers_url'   => 'https://api.github.com/repos/devboard/test-hitman/subscribers',
            'subscription_url'  => 'https://api.github.com/repos/devboard/test-hitman/subscription',
            'commits_url'       => 'https://api.github.com/repos/devboard/test-hitman/commits{/sha}',
            'git_commits_url'   => 'https://api.github.com/repos/devboard/test-hitman/git/commits{/sha}',
            'comments_url'      => 'https://api.github.com/repos/devboard/test-hitman/comments{/number}',
            'issue_comment_url' => 'https://api.github.com/repos/devboard/test-hitman/issues/comments{/number}',
            'contents_url'      => 'https://api.github.com/repos/devboard/test-hitman/contents/{+path}',
            'compare_url'       => 'https://api.github.com/repos/devboard/test-hitman/compare/{base}...{head}',
            'merges_url'        => 'https://api.github.com/repos/devboard/test-hitman/merges',
            'archive_url'       => 'https://api.github.com/repos/devboard/test-hitman/{archive_format}{/ref}',
            'downloads_url'     => 'https://api.github.com/repos/devboard/test-hitman/downloads',
            'issues_url'        => 'https://api.github.com/repos/devboard/test-hitman/issues{/number}',
            'pulls_url'         => 'https://api.github.com/repos/devboard/test-hitman/pulls{/number}',
            'milestones_url'    => 'https://api.github.com/repos/devboard/test-hitman/milestones{/number}',
            'notifications_url' => 'https://api.github.com/repos/devboard/test-hitman/notifications{?since,all,participating}',
            'labels_url'        => 'https://api.github.com/repos/devboard/test-hitman/labels{/name}',
            'releases_url'      => 'https://api.github.com/repos/devboard/test-hitman/releases{/id}',
            'created_at'        => '2015-08-21T19:25:38Z',
            'updated_at'        => '2015-08-21T19:25:38Z',
            'pushed_at'         => '2015-08-21T19:25:38Z',
            'git_url'           => 'git://github.com/devboard/test-hitman.git',
            'ssh_url'           => 'git@github.com:devboard/test-hitman.git',
            'clone_url'         => 'https://github.com/devboard/test-hitman.git',
            'svn_url'           => 'https://github.com/devboard/test-hitman',
            'homepage'          => null,
            'size'              => 120,
            'stargazers_count'  => 0,
            'watchers_count'    => 0,
            'language'          => null,
            'has_issues'        => true,
            'has_downloads'     => true,
            'has_wiki'          => true,
            'has_pages'         => false,
            'forks_count'       => 0,
            'mirror_url'        => null,
            'open_issues_count' => 0,
            'forks'             => 0,
            'open_issues'       => 0,
            'watchers'          => 0,
            'default_branch'    => 'master',
            'organization'      => [
                'login'               => 'devboard',
                'id'                  => 13396338,
                'avatar_url'          => 'https://avatars.githubusercontent.com/u/13396338?v=3',
                'gravatar_id'         => '',
                'url'                 => 'https://api.github.com/users/devboard',
                'html_url'            => 'https://github.com/devboard',
                'followers_url'       => 'https://api.github.com/users/devboard/followers',
                'following_url'       => 'https://api.github.com/users/devboard/following{/other_user}',
                'gists_url'           => 'https://api.github.com/users/devboard/gists{/gist_id}',
                'starred_url'         => 'https://api.github.com/users/devboard/starred{/owner}{/repo}',
                'subscriptions_url'   => 'https://api.github.com/users/devboard/subscriptions',
                'organizations_url'   => 'https://api.github.com/users/devboard/orgs',
                'repos_url'           => 'https://api.github.com/users/devboard/repos',
                'events_url'          => 'https://api.github.com/users/devboard/events{/privacy}',
                'received_events_url' => 'https://api.github.com/users/devboard/received_events',
                'type'                => 'Organization',
                'site_admin'          => false,
            ],
            'network_count'     => 0,
            'subscribers_count' => 3,
        ];

        $result = $this->create($arr);

        $result->shouldBeAnInstanceOf('NullDev\GithubApi\Repo\GithubRepoData');
    }
}
