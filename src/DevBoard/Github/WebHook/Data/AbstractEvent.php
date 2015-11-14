<?php
namespace DevBoard\Github\WebHook\Data;

use DevBoard\Github\WebHook\WebHookSignature;

/**
 * Class AbstractEvent.
 */
abstract class AbstractEvent
{
    private $signature;
    private $rawPayload;

    /**
     * Constructor.
     *
     * @param WebHookSignature $signature
     * @param                  $rawPayload
     */
    public function __construct(WebHookSignature $signature, $rawPayload)
    {
        $this->signature  = $signature;
        $this->rawPayload = $rawPayload;
    }

    /**
     * @return WebHookSignature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    public function getRawPayload()
    {
        return $this->rawPayload;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return json_decode($this->rawPayload);
    }
}
