<?php
namespace DevBoard\Behat\Github\Branch;

use DevBoard\Github\Branch\Entity\GithubBranch;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param $repo
     * @param $name
     *
     * @throws \Exception
     *
     * @return
     */
    private function getGithubBranchByName($repo, $name)
    {
        $branch = $this->getGithubBranchRepository()
            ->findOneByName(
                $repo,
                $name
            );

        if (!$branch) {
            throw new \Exception('Cant find github branch with name:'.$name);
        }

        return $branch;
    }

    /**
     * @return mixed
     */
    private function getGithubBranchRepository()
    {
        return $this->getEntityManager()->getRepository('GhBranch:GithubBranch');
    }

    /**
     * @param $name
     *
     * @return GithubBranch
     */
    private function createBranchObjectFromBranchName($name)
    {
        $branch = new GithubBranch();
        $branch->setName($name);

        return $branch;
    }
}
