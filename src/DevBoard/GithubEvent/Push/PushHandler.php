<?php
namespace DevBoard\GithubEvent\Push;

use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Branch\BranchHandler;
use DevBoard\GithubEvent\Push\Tag\TagHandler;
use Exception;

/**
 * Class PushHandler.
 */
class PushHandler
{
    private $branchHandler;
    private $tagHandler;

    /**
     * PushHandler constructor.
     *
     * @param BranchHandler $branchHandler
     * @param TagHandler    $tagHandler
     */
    public function __construct(BranchHandler $branchHandler, TagHandler $tagHandler)
    {
        $this->branchHandler = $branchHandler;
        $this->tagHandler    = $tagHandler;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @throws Exception
     *
     * @return bool
     */
    public function process(PushPayload $pushPayload)
    {
        if ($pushPayload->isCreate()) {
            return $this->getHandler($pushPayload)->create($pushPayload);
        } elseif ($pushPayload->isUpdate()) {
            return $this->getHandler($pushPayload)->update($pushPayload);
        } elseif ($pushPayload->isDelete()) {
            return $this->getHandler($pushPayload)->delete($pushPayload);
        } else {
            throw new Exception('Unsupported push payload: payload should be create/update/delete!');
        }
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @throws Exception
     *
     * @return BranchHandler|TagHandler
     */
    private function getHandler(PushPayload $pushPayload)
    {
        if ($pushPayload->isBranch()) {
            return $this->branchHandler;
        } elseif ($pushPayload->isTag()) {
            return $this->tagHandler;
        }

        throw new Exception('Unsupported push payload: payload should be branch or tag!');
    }
}
