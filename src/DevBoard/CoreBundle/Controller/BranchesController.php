<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class BranchesController.
 */
class BranchesController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function liveAction()
    {
        $em = $this->getDoctrine();

        $projects = $this->getProjects();
        $repos    = $em->getRepository('GhRepo:GithubRepo')->getRepoIdsFromProjectIds($projects);
        $branches = $em->getRepository('GhBranch:GithubBranch')->getLiveBranchesFromRepoIds($repos, 1);

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
