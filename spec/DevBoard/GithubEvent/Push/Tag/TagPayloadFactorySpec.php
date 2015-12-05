<?php
namespace spec\DevBoard\GithubEvent\Push\Tag;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Tag\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Tag\Data\RepoFactory;
use DevBoard\GithubEvent\Push\Tag\Data\TagFactory;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagPayloadFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\TagPayloadFactory');
    }

    public function let(
        RepoFactory $repoFactory,
        TagFactory $tagFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->beConstructedWith(
            $repoFactory,
            $tagFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory
        );
    }

    public function it_will_create_tag_payload_from_push_payload(
        $repoFactory,
        $tagFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        PushPayload $pushPayload,
        Repo $repo,
        Tag $tag,
        Commit $commit,
        CommitAuthor $commitAuthor,
        CommitCommitter $commitCommitter
    ) {
        $repoFactory->create($pushPayload)->willReturn($repo);
        $tagFactory->create($pushPayload)->willReturn($tag);
        $commitFactory->create($pushPayload)->willReturn($commit);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthor);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitter);

        $this->create($pushPayload)->shouldReturnAnInstanceOf('DevBoard\GithubEvent\Push\Tag\TagPayload');
    }
}
