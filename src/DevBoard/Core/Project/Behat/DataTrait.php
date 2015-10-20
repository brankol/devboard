<?php
namespace DevBoard\Core\Project\Behat;

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
    private function getProjectByName($name)
    {
        $project = $this->getProjectRepository()->findOneByProjectName($name);

        if (!$project) {
            throw new \Exception('Cant find project with name:'.$name);
        }
    }

    /**
     * @return mixed
     */
    private function getProjectRepository()
    {
        return $this->getEntityManager()->getRepository('DevBoardProject:Project');
    }
}
