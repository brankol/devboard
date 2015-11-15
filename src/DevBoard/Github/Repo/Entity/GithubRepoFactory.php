<?php
namespace DevBoard\Github\Repo\Entity;

/**
 * Class GithubRepoFactory.
 */
class GithubRepoFactory
{
    /**
     * @param string $fullName
     *
     * @return GithubRepo
     */
    public function create($fullName)
    {
        list($owner, $name) = explode('/', $fullName);

        $githubRepo = new GithubRepo();
        $githubRepo->setOwner($owner);
        $githubRepo->setName($name);

        return $githubRepo;
    }
}
