<?php
namespace spec\DevBoard\GithubEvent\Payload;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatusPayloadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Payload\StatusPayload');
    }

    public function let()
    {
        $data = [
            'id'          => 1234,
            'sha'         => '123abc',
            'name'        => 'owner/name',
            'target_url'  => 'https://travis-ci.org/owner/name/builds/92845894',
            'context'     => 'continuous-integration/travis-ci/push',
            'description' => 'The Travis CI build passed',
            'state'       => 'success',
            'commit'      => ['commit-details'],
            'branches'    => [
                [
                    'name'   => 'master',
                    'commit' => [
                        'sha' => '123abc',
                        'url' => 'https://api.github.com/repos/owner/name/commits/123abc',
                    ],
                ],
                [
                    'name'   => 'dev',
                    'commit' => [
                        'sha' => '123abc',
                        'url' => 'https://api.github.com/repos/owner/name/commits/123abc',
                    ],
                ],
            ],
            'created_at' => '2015-11-24T01:29:22Z',
            'updated_at' => '2015-11-24T01:29:22Z',
            'repository' => ['repo-details'],
            'sender'     => [],
        ];

        $this->beConstructedWith($data);
    }

    public function it_exposes_commit_sha()
    {
        $this->getSha()->shouldReturn('123abc');
    }

    public function it_exposes_full_repo_name()
    {
        $this->getGithubRepoFullName()->shouldReturn('owner/name');
    }

    public function it_exposes_context()
    {
        $this->getContext()->shouldReturn('continuous-integration/travis-ci/push');
    }

    public function it_exposes_description()
    {
        $this->getDescription()->shouldReturn('The Travis CI build passed');
    }

    public function it_exposes_state()
    {
        $this->getState()->shouldReturn('success');
    }

    public function it_exposes_repository_details()
    {
        $this->getRepositoryDetails()->shouldReturn(['repo-details']);
    }

    public function it_exposes_commit_details()
    {
        $this->getCommitDetails()->shouldReturn(['commit-details']);
    }

    public function it_exposes_target_url()
    {
        $this->getTargetUrl()->shouldReturn('https://travis-ci.org/owner/name/builds/92845894');
    }
}
