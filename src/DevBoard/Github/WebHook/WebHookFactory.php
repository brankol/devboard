<?php
namespace DevBoard\Github\WebHook;

use DevBoard\Github\WebHook\Data\PullRequestEvent;
use DevBoard\Github\WebHook\Data\PushEvent;
use DevBoard\Github\WebHook\Data\StatusEvent;
use Exception;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebHookFactory.
 */
class WebHookFactory
{
    private $signatureFactory;

    /**
     * WebHookFactory constructor.
     *
     * @param WebHookSignatureFactory $signatureFactory
     */
    public function __construct(WebHookSignatureFactory $signatureFactory)
    {
        $this->signatureFactory = $signatureFactory;
    }

    /**
     * @param Request $request
     *
     * @throws Exception
     *
     * @return PushEvent
     */
    public function create(Request $request)
    {
        $event     = $request->headers->get('X-GitHub-Event');
        $signature = $this->getSignature($request->headers);

        if ('push' === $event) {
            return new PushEvent($signature, $request->getContent());
        } elseif ('status' === $event) {
            return new StatusEvent($signature, $request->getContent());
        } elseif ('pull_request' === $event) {
            return new PullRequestEvent($signature, $request->getContent());
        } else {
            throw new Exception('Unsupported webhook event: "'.$event.'" !');
        }
    }

    /**
     * @param HeaderBag $headerBag
     *
     * @return WebHookSignature
     */
    private function getSignature(HeaderBag $headerBag)
    {
        return $this->signatureFactory->create($headerBag->get('X-Hub-Signature'));
    }

    /**
     * @param array $queueNotification
     *
     * @throws Exception
     *
     * @return PullRequestEvent|PushEvent|StatusEvent
     */
    public function createFromQueueNotification(array $queueNotification)
    {
        $event     = $queueNotification['eventType'];
        $signature = $this->signatureFactory->create($queueNotification['signature']);
        $content   = $queueNotification['content'];

        if ('push' === $event) {
            return new PushEvent($signature, $content);
        } elseif ('status' === $event) {
            return new StatusEvent($signature, $content);
        } elseif ('pull_request' === $event) {
            return new PullRequestEvent($signature, $content);
        } else {
            throw new Exception('Unsupported webhook event: "'.$event.'" !');
        }
    }
}
