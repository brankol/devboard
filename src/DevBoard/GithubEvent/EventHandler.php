<?php
namespace DevBoard\GithubEvent;

use DevBoard\Github\WebHook\Data\AbstractEvent;
use DevBoard\GithubEvent\Payload\PayloadFactory;
use DevBoard\GithubEvent\Payload\PullRequestPayload;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubEvent\PullRequest\PullRequestHandler;
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
    protected $pullRequestHandler;

    /**
     * EventHandler constructor.
     *
     * @param PayloadFactory     $payloadFactory
     * @param PushHandler        $pushHandler
     * @param StatusHandler      $statusHandler
     * @param PullRequestHandler $pullRequestHandler
     */
    public function __construct(
        PayloadFactory $payloadFactory,
        PushHandler $pushHandler,
        StatusHandler $statusHandler,
        PullRequestHandler $pullRequestHandler
    ) {
        $this->payloadFactory     = $payloadFactory;
        $this->pushHandler        = $pushHandler;
        $this->statusHandler      = $statusHandler;
        $this->pullRequestHandler = $pullRequestHandler;
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
        } elseif ($payload instanceof PullRequestPayload) {
            $this->pullRequestHandler->process($payload);
        } else {
            throw new Exception('Non supported payload:'.get_class($payload));
        }

        return true;
    }
}
