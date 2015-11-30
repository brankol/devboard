<?php
namespace DevBoard\GithubEvent\Payload;

/**
 * Class StatusPayload.
 */
class StatusPayload
{
    private $data;

    /**
     * PushPayload constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
