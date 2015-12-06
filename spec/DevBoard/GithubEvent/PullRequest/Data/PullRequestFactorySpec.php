<?php
namespace spec\DevBoard\GithubEvent\PullRequest\Data;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\Data\PullRequestFactory');
    }

    public function it_will_create_remote_pullRequest_value_object(PullRequestPayload $pullRequestPayload)
    {
        $data = [
            'number' => 169,
            'state'  => 'open',
            'locked' => false,
            'title'  => 'title',
            'user'   => [
                'login'      => 'devboard-john',
                'id'         => 123,
                'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
            ],
            'body'       => 'body',
            'created_at' => '2015-12-06T14:43:34Z',
            'updated_at' => '2015-12-06T14:43:34Z',
            'assignee'   => null,
            'head'       => [
                'label' => 'devboard-john:168-clean-up-services',
                'ref'   => '168-clean-up-services',
                'sha'   => '0a32e2351a426211b6bffaf271cb6bc005fc67c9',
                'user'  => [
                    'login'      => 'devboard-john',
                    'id'         => 123,
                    'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
                ],
                'repo' => [
                    'id'        => 39307551,
                    'name'      => 'devboard',
                    'full_name' => 'devboard-john/devboard',
                    'owner'     => [
                        'login'      => 'devboard-john',
                        'id'         => 123,
                        'avatar_url' => 'https://avatars.githubusercontent.com/u/123?v=3',
                    ],
                ],
            ],
            'base' => [
                'label' => 'devboard:master',
                'ref'   => 'master',
                'sha'   => 'cf2a0df3f01811bfeab22981b259b41bf5d344c4',
                'user'  => [
                    'login'      => 'devboard',
                    'id'         => 13396338,
                    'avatar_url' => 'https://avatars.githubusercontent.com/u/13396338?v=3',
                ],
                'repo' => [
                    'id'        => 39307548,
                    'name'      => 'devboard',
                    'full_name' => 'devboard/devboard',
                    'owner'     => [
                        'login'      => 'devboard',
                        'id'         => 13396338,
                        'avatar_url' => 'https://avatars.githubusercontent.com/u/13396338?v=3',
                    ],
                ],
            ],
            '_links'          => [],
            'merged'          => false,
            'mergeable'       => null,
            'mergeable_state' => 'unknown',
            'merged_by'       => null,
            'comments'        => 0,
            'review_comments' => 0,
            'commits'         => 2,
            'additions'       => 193,
            'deletions'       => 184,
            'changed_files'   => 10,

        ];

        $pullRequestPayload->getPullRequestDetails()->willReturn($data);

        $result = $this->create($pullRequestPayload);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest');
    }
}
