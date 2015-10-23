<?php
namespace NullDev\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConnectController.
 */
class ConnectController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function githubAction(Request $request)
    {
        $this->startSessionIfNotStarted($request);

        if ('test' === $this->getCurrentApplicationEnvironment()) {
            $scopeParamName    = 'github_default_scope_test';
            $clientIdParamName = 'github_client_id_test';
        } else {
            $scopeParamName    = 'github_default_scope';
            $clientIdParamName = 'github_client_id';
        }

        $scope    = $this->container->getParameter($scopeParamName);
        $clientId = $this->container->getParameter($clientIdParamName);

        $url = 'https://github.com/login/oauth/authorize?scope='.$scope.'&client_id='.$clientId;

        return $this->redirect($url, 302);
    }

    /**
     * @param Request $request
     */
    private function startSessionIfNotStarted(Request $request)
    {
        $session = $request->getSession();

        if (!$session->isStarted()) {
            $session->setName('PHPSESSID');
            $session->start();
        }
    }

    /**
     * @return string
     */
    private function getCurrentApplicationEnvironment()
    {
        return $this->container->get('kernel')->getEnvironment();
    }
}
