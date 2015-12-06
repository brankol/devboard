<?php
namespace spec\DevBoard\GithubEvent\PullRequest;

use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubEvent\PullRequest\Data\CommitFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestAssigneeFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestCreatorFactory;
use DevBoard\GithubEvent\PullRequest\Data\PullRequestFactory;
use DevBoard\GithubEvent\PullRequest\Data\RepoFactory;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PullRequestPayloadFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\PullRequest\PullRequestPayloadFactory');
    }

    public function let(
        RepoFactory $repoFactory,
        PullRequestFactory $pullRequestFactory,
        CommitFactory $commitFactory,
        PullRequestCreatorFactory $pullRequestCreatorFactory,
        PullRequestAssigneeFactory $pullRequestAssigneeFactory
    ) {
        $this->beConstructedWith(
            $repoFactory,
            $pullRequestFactory,
            $commitFactory,
            $pullRequestCreatorFactory,
            $pullRequestAssigneeFactory
        );
    }

    public function it_will_create_pull_request_payload_from_push_payload(
        $repoFactory,
        $pullRequestFactory,
        $commitFactory,
        $pullRequestCreatorFactory,
        $pullRequestAssigneeFactory,
        PullRequestPayload $pullRequestPayload,
        Repo $repo,
        PullRequest $pullRequest,
        Commit $commit,
        CommitAuthor $commitAuthor,
        CommitCommitter $commitCommitter
    ) {
        $repoFactory->create($pullRequestPayload)->willReturn($repo);
        $pullRequestFactory->create($pullRequestPayload)->willReturn($pullRequest);
        $commitFactory->create($pullRequestPayload)->willReturn($commit);
        $pullRequestCreatorFactory->create($pullRequestPayload)->willReturn($commitAuthor);
        $pullRequestAssigneeFactory->create($pullRequestPayload)->willReturn($commitCommitter);

        $this->create($pullRequestPayload)
            ->shouldReturnAnInstanceOf('DevBoard\GithubEvent\PullRequest\PullRequestPayload');
    }
}
