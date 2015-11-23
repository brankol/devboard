<?php
namespace spec\DevBoard\GithubRemote\Fetch\Branch\Data;

use NullDev\GithubApi\Branch\GithubBranchData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubRemote\Fetch\Branch\Data\CommitFactory');
    }

    public function it_will_create_remote_commit_value_object(GithubBranchData $githubBranchData)
    {
        $data = [
            'sha'    => 'sha',
            'commit' => [
                'author' => [
                    'date' => '2015-08-21T19:25:38Z',
                ],
                'committer' => [
                    'date' => '2015-08-21T19:25:38Z',
                ],
                'message' => 'Message',
            ],

        ];

        $githubBranchData->getCommitData()->willReturn($data);

        $result = $this->create($githubBranchData);
        $result->shouldReturnAnInstanceOf('DevBoard\GithubRemote\ValueObject\Commit\Commit');

        $result->getSha()->shouldReturn('sha');
        $result->getMessage()->shouldReturn('Message');
    }
}
