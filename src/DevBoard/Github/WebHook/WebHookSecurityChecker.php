<?php
namespace DevBoard\Github\WebHook;

use DevBoard\Github\WebHook\Data\AbstractEvent;

/**
 * Class WebHookSecurityChecker.
 */
class WebHookSecurityChecker
{
    private $secret;

    /**
     * WebHookSecurityChecker constructor.
     *
     * @param string $secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param AbstractEvent $event
     *
     * @return bool
     */
    public function check(AbstractEvent $event)
    {
        $payLoadHash = hash_hmac($event->getSignature()->getAlgorithm(), $event->getRawPayload(), $this->secret);

        if ($payLoadHash === $event->getSignature()->getSignature()) {
            return true;
        } else {
            return false;
        }
    }
}
