<?php
namespace DevBoard\Behat\Github\Branch;

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
    private function getGithubBranchByName($name)
    {
        $branch = $this->getGithubBranchRepository()
            ->findOneByName(
                $this->repo,
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
}
