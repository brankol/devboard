<?php
namespace DevBoard\GithubEvent\Push\Tag;

use DevBoard\GithubEvent\Payload\PushPayload;

//@TODO
/**
 * Class TagHandler.
 */
class TagHandler
{
    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @TODO
     */
    public function create(PushPayload $pushPayload)
    {
        return true;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @TODO
     */
    public function update(PushPayload $pushPayload)
    {
        return true;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @TODO
     */
    public function delete(PushPayload $pushPayload)
    {
        return true;
    }
}
