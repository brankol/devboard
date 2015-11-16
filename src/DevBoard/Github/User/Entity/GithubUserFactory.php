<?php
namespace DevBoard\Github\User\Entity;

/**
 * Class GithubUserFactory.
 */
class GithubUserFactory
{
    /**
     * @param $username
     *
     * @return GithubUser
     */
    public function create($username)
    {
        $githubUser = new GithubUser();
        $githubUser->setUsername($username);

        return $githubUser;
    }
}
