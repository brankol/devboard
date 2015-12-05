<?php
namespace DevBoard\GithubEvent\Push\Tag;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Tag\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Tag\Data\RepoFactory;
use DevBoard\GithubEvent\Push\Tag\Data\TagFactory;

/**
 * Class TagPayloadFactory.
 */
class TagPayloadFactory
{
    private $repoFactory;
    private $tagFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    /**
     * TagPayloadFactory constructor.
     *
     * @param RepoFactory            $repoFactory
     * @param TagFactory             $tagFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     */
    public function __construct(
        RepoFactory $repoFactory,
        TagFactory $tagFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory
    ) {
        $this->repoFactory            = $repoFactory;
        $this->tagFactory             = $tagFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return TagPayload
     */
    public function create(PushPayload $pushPayload)
    {
        return new TagPayload(
            $this->repoFactory->create($pushPayload),
            $this->tagFactory->create($pushPayload),
            $this->commitFactory->create($pushPayload),
            $this->commitAuthorFactory->create($pushPayload),
            $this->commitCommitterFactory->create($pushPayload)

        );
    }
}
