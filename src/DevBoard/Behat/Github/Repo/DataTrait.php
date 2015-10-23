<?php
namespace DevBoard\Behat\Github\Repo;

use DevBoard\Github\Repo\GithubRepo;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param GithubRepo $repo
     * @param            $fullName
     *
     * @return GithubRepo
     */
    private function fillRepoWithDetails(GithubRepo $repo, $fullName)
    {
        list($owner, $name) = explode('/', $fullName);

        $repo->setGithubId(51234)
            ->setOwner($owner)
            ->setName($name)
            ->setFullName($fullName)
            ->setHtmlUrl('http://')
            ->setDescription('Description')
            ->setFork(0)
            ->setDefaultBranch('master')
            ->setGithubPrivate(0)
            ->setGitUrl('git://')
            ->setSshUrl('ssh://')
            ->setGithubCreatedAt(new \DateTime('2015-01-10 11:12:13'))
            ->setGithubUpdatedAt(new \DateTime('2015-01-10 11:12:13'))
            ->setGithubPushedAt(new \DateTime('2015-01-10 11:12:13'));

        return $repo;
    }

    /**
     * @param $fullName
     *
     * @throws \Exception
     */
    private function getGithubRepoByFullName($fullName)
    {
        $repo = $this->getGithubRepoRepository()->findOneByFullName($fullName);

        if (!$repo) {
            throw new \Exception('Cant find github repo with full name:'.$fullName);
        }

        return $repo;
    }

    /**
     * @return mixed
     */
    private function getGithubRepoRepository()
    {
        return $this->getEntityManager()->getRepository('GhRepo:GithubRepo');
    }
}
