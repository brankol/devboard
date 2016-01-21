<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PullRequestsController.
 */
class PullRequestsController extends Controller
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function openAction(Request $request)
    {
        $em = $this->getDoctrine();

        $timeInHours = (int) $request->get('hours');

        if (!$timeInHours) {
            $timeInHours = 1;
        }

        $projects     = $this->getProjects();
        $repos        = $em->getRepository('GhRepo:GithubRepo')->getRepoIdsFromProjectIds($projects);
        $pullRequests = $em->getRepository('GhPullRequest:GithubPullRequest')->getOpenPullRequestsFromRepoIds($repos);

        $response = new JsonResponse();
        $response->setData($this->prepare($pullRequests));

        return $response;
    }

    /**
     * @param $pullRequests
     *
     * @return array
     */
    private function prepare($pullRequests)
    {
        $results = [];

        foreach ($pullRequests as $pullRequest) {
            $results[] = $pullRequest->getLiveInfo();
        }

        return $results;
    }

    /**
     * @return mixed
     */
    private function getProjects()
    {
        return $this->getDoctrine()
            ->getRepository('DevBoardProject:Project')
            ->getUserProjectIds($this->getUser());
    }
}
