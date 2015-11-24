<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $data = [];

        return $this->render('DevBoardCoreBundle:Dashboard:index.html.twig', $data);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function liveBranchesAction()
    {
        $em = $this->getDoctrine();

        $projects = $this->getProjects();
        $repos    = $em->getRepository('GhRepo:GithubRepo')->getRepoIdsFromProjectIds($projects);
        $branches = $em->getRepository('GhBranch:GithubBranch')->getLiveBranchesFromRepoIds($repos);

        $data = [
            'branches' => $branches,
        ];

        return $this->render('DevBoardCoreBundle:Dashboard:livebranches.html.twig', $data);
    }

    private function getProjects()
    {
        return $this->getDoctrine()
            ->getRepository('DevBoardProject:Project')
            ->getUserProjectIds($this->getUser());
    }
}
