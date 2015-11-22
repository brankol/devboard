<?php
namespace DevBoard\GithubEvent;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\GithubEvent\Payload\PayloadFactory;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\PushHandler;
use Exception;

/**
 * Class EventHandler.
 */
class EventHandler
{
    private $payloadFactory;
    private $pushHandler;

    /**
     * EventHandler constructor.
     *
     * @param PayloadFactory $payloadFactory
     * @param PushHandler    $pushHandler
     */
    public function __construct(PayloadFactory $payloadFactory, PushHandler $pushHandler)
    {
        $this->payloadFactory = $payloadFactory;
        $this->pushHandler    = $pushHandler;
    }

    /**
     * @param AbstractEvent $event
     *
     * @throws Exception
     *
     * @return bool
     */
    public function handle(AbstractEvent $event)
    {
        $payload = $this->payloadFactory->create($event);

        if ($payload instanceof PushPayload) {
            $this->pushHandler->process($payload);
        } else {
            throw new Exception('Non supported payload:'.get_class($payload));
        }

        return true;
    }
}
