<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();

        $projects = $this->getProjects();
        $repos    = $em->getRepository('GhRepo:GithubRepo')->getRepoIdsFromProjectIds($projects);
        $branches = $em->getRepository('GhBranch:GithubBranch')->getBranchesFromRepoIds($repos);

        $data = [
            'branches' => $branches,
        ];

        return $this->render('DevBoardCoreBundle:Default:index.html.twig', $data);
    }

    private function getProjects()
    {
        return $this->getDoctrine()
            ->getRepository('DevBoardProject:Project')
            ->getUserProjectIds($this->getUser());
    }
}
