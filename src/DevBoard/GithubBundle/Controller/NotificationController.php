<?php
namespace DevBoard\GithubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NotificationController.
 */
class NotificationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function incomingAction(Request $request)
    {
        $logger = $this->get('monolog.logger.ghnotifictation');

        $hookFactory = $this->get('github.webhook.factory');

        $event = $hookFactory->create($request);

        $securityChecker = $this->get('github.webhook.security_checker');

        if (!$securityChecker->check($event)) {
            $logger->error('Signatures dont match!');
        } else {
            $payload = $event->getPayload();

            $repo = $payload->repository->full_name;

            $branch = $payload->ref;

            $logger->info('Repo:'.$repo);
            $logger->info('Branch:'.$branch);
        }

        return $this->render('DevBoardGithubBundle:Default:index.html.twig', ['name' => 'github']);
    }
}
