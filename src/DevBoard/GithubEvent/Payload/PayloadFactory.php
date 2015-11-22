<?php
namespace DevBoard\GithubEvent\Payload;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\Github\WebHook\Data\PushEvent;
use Exception;

/**
 * Class PayloadFactory.
 */
class PayloadFactory
{
    /**
     * @param AbstractEvent $event
     *
     * @throws Exception
     *
     * @return PushPayload
     */
    public function create(AbstractEvent $event)
    {
        if ($event instanceof PushEvent) {
            return new PushPayload($event->getPayload());
        }

        throw new Exception('Unknown WebHook Event:'.get_class($event));
    }
}
