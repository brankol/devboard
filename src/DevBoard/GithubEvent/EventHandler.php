<?php
namespace DevBoard\GithubEvent;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\GithubEvent\Payload\PayloadFactory;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubEvent\Push\PushHandler;
use DevBoard\GithubEvent\Status\StatusHandler;
use Exception;

/**
 * Class EventHandler.
 */
class EventHandler
{
    private $payloadFactory;
    private $pushHandler;
    private $statusHandler;

    /**
     * EventHandler constructor.
     *
     * @param PayloadFactory $payloadFactory
     * @param PushHandler    $pushHandler
     */
    public function __construct(PayloadFactory $payloadFactory, PushHandler $pushHandler, StatusHandler $statusHandler)
    {
        $this->payloadFactory = $payloadFactory;
        $this->pushHandler    = $pushHandler;
        $this->statusHandler  = $statusHandler;
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
        } elseif ($payload instanceof StatusPayload) {
            $this->statusHandler->process($payload);
        } else {
            throw new Exception('Non supported payload:'.get_class($payload));
        }

        return true;
    }
}
