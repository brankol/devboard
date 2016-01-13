<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BranchesController.
 */
class BranchesController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function liveAction(Request $request)
    {
        $em = $this->getDoctrine();

        $timeInHours = (int) $request->get('hours');

        if (!$timeInHours) {
            $timeInHours = 1;
        }

        $projects = $this->getProjects();
        $repos    = $em->getRepository('GhRepo:GithubRepo')->getRepoIdsFromProjectIds($projects);
        $branches = $em->getRepository('GhBranch:GithubBranch')->getLiveBranchesFromRepoIds($repos, $timeInHours);

        $response = new JsonResponse();
        $response->setData($this->prepare($branches));

        return $response;
    }

    /**
     * @param $branches
     *
     * @return array
     */
    private function prepare($branches)
    {
        $results = [];

        foreach ($branches as $branch) {
            $results[] = $branch->getLiveInfo();
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
