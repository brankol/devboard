<?php
namespace DevBoard\Behat\Github\User;

use DevBoard\Github\User\Entity\GithubUser;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param $name
     *
     * @throws \Exception
     */
    private function getGithubUserByName($name)
    {
        $user = $this->getGithubUserRepository()->findOneByName($name);

        if (!$user) {
            throw new \Exception('Cant find github user with name:'.$name);
        }
    }

    /**
     * @param $username
     *
     * @throws \Exception
     */
    private function getGithubUserByUsername($username)
    {
        $user = $this->getGithubUserRepository()->findOneByUsername($username);

        if (!$user) {
            throw new \Exception('Cant find github user with username:'.$username);
        }

        return $user;
    }

    /**
     * @return mixed
     */
    private function getGithubUserRepository()
    {
        return $this->getEntityManager()->getRepository('GhUser:GithubUser');
    }

    /**
     * @param string $username
     *
     * @return GithubUser
     */
    private function createUserObjectFromUsername($username)
    {
        $githubUser = new GithubUser();

        $githubUser->setUsername($username);

        return $githubUser;
    }
}
