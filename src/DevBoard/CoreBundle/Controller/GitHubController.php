<?php
namespace DevBoard\CoreBundle\Controller;

use DevBoard\Core\CreateProject\OrganizationContainer;
use DevBoard\Core\CreateProject\RepositoryCollection;
use DevBoard\Core\CreateProject\UserContainer;
use DevBoard\GithubRemote\ValueObject\Organization\OrganizationInfo;
use DevBoard\GithubRemote\ValueObject\Repo\RepoInfo;
use DevBoard\GithubRemote\ValueObject\User\UserInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * GitHub controller.
 */
class GitHubController extends Controller
{
    private $client;

    /**
     * Lists all Project entities.
     */
    public function indexAction()
    {
        $templateData = [
            'containers' => $this->getContainers(),
            'createForm' => $this->getCreateForm(),
        ];

        return $this->render('DevBoardCoreBundle:GitHub:index.html.twig', $templateData);
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @return array
     */
    private function getContainers()
    {
        $containers = [];

        // my container

        $myContainer = new UserContainer(
            $this->getMyInfo(),
            $this->getMyRepos()
        );

        $containers[] = $myContainer;

        foreach ($this->getMyOrganizations() as $organization) {
            $orgContainer = new OrganizationContainer(
                $organization,
                $this->getOrganizationRepos($organization)
            );

            $containers[] = $orgContainer;
        }

        return $containers;
    }

    /**
     * @return mixed
     */
    private function getCreateForm()
    {
        return $this->get('core.project.create.form_container.factory')->create();
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @return UserInfo|mixed
     */
    private function getMyInfo()
    {
        $key = 'cache.github.user.info';

        $content = $this->getFromSession($key);

        if (null === $content) {
            $content = $this->fetchMyInfo();

            $this->setToSession($key, $content);
        }

        return $content;
    }

    /**
     * @return UserInfo
     */
    private function fetchMyInfo()
    {
        $myInfo = $this->getClient()->me()->show();

        $result = new UserInfo(
            $myInfo['id'],
            $myInfo['name'],
            $myInfo['email'],
            $myInfo['login'],
            $myInfo['avatar_url']
        );

        return $result;
    }

    /**
     * @return mixed
     */
    private function getMyRepos()
    {
        $key = 'cache.github.user.repos';

        $content = $this->getFromSession($key);

        if (null === $content) {
            $content = $this->fetchMyRepos();

            $this->setToSession($key, $content);
        }

        return $this->onlyUntrackedRepos($content);
    }

    /**
     * @return RepositoryCollection
     */
    private function fetchMyRepos()
    {
        $myRepos = $this->getClient()->me()->repositories();

        $results = new RepositoryCollection();

        foreach ($myRepos as $repoData) {
            $repoInfo = new RepoInfo($repoData['owner']['login'], $repoData['name']);

            $results->add($repoInfo);
        }

        return $results;
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @return array|mixed
     */
    private function getMyOrganizations()
    {
        $key = 'cache.github.user.organizations';

        $content = $this->getFromSession($key);

        if (null === $content) {
            $content = $this->fetchMyOrganizations();

            $this->setToSession($key, $content);
        }

        return $content;
    }

    /**
     * @return array
     */
    private function fetchMyOrganizations()
    {
        $organizations = $this->getClient()->me()->organizations();

        $results = [];

        foreach ($organizations as $organization) {
            $results[] = new OrganizationInfo($organization['id'], $organization['login'], $organization['avatar_url']);
        }

        return $results;
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @param OrganizationInfo $organization
     *
     * @return mixed
     */
    private function getOrganizationRepos(OrganizationInfo $organization)
    {
        $key = 'cache.github.'.$organization->getOrganizationName().'.repos';

        $content = $this->getFromSession($key);

        if (null === $content) {
            $content = $this->fetchOrganizationRepos($organization);

            $this->setToSession($key, $content);
        }

        return $this->onlyUntrackedRepos($content);
    }

    /**
     * @param OrganizationInfo $organization
     *
     * @return RepositoryCollection
     */
    private function fetchOrganizationRepos(OrganizationInfo $organization)
    {
        $orgRepos = $this->getClient()->organization()->repositories($organization->getOrganizationName());

        $results = new RepositoryCollection();

        foreach ($orgRepos as $repoData) {
            $repoInfo = new RepoInfo($repoData['owner']['login'], $repoData['name']);

            $results->add($repoInfo);
        }

        return $results;
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @param $repos
     *
     * @return mixed
     */
    private function onlyUntrackedRepos($repos)
    {
        foreach ($repos as $key => $repo) {
            if ($this->userAlreadyTracking($repo)) {
                $repos->remove($key);
            }
        }

        return $repos;
    }

    /**
     * @param RepoInfo $repo
     *
     * @return bool
     */
    private function userAlreadyTracking(RepoInfo $repo)
    {
        $projectRepo = $this->getDoctrine()->getRepository('DevBoardProject:Project');

        $criteria = [
            'projectName' => $repo->getFullName(),
            'user'        => $this->getUser(),
        ];

        $result = $projectRepo->findOneBy($criteria);

        if (null === $result) {
            return false;
        } else {
            return true;
        }
    }

    //----------------------------------------------------------------------------------------------------

    /**
     * @param $key
     *
     * @return mixed
     */
    private function getFromSession($key)
    {
        $key .= 'a11';

        return $this->get('session')->get($key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    private function setToSession($key, $value)
    {
        $key .= 'a11';

        return $this->get('session')->set($key, $value);
    }

    private function getClient()
    {
        if (null === $this->client) {
            $clientFactory = $this->get('null_dev_github_api.client.authenticated.factory.token');
            $this->client  = $clientFactory->create($this->getUser());
        }

        return $this->client;
    }
}
