<?php
namespace DevBoard\GithubEvent\Push\Tag\Data;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;

/**
 * Class TagFactory.
 */
class TagFactory
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return Tag
     */
    public function create(PushPayload $pushPayload)
    {
        return new Tag(
            $pushPayload->getTagName()
        );
    }
}
