<?php
namespace DevBoard\Core\Project\Entity;

/**
 * Class ProjectFactory.
 */
class ProjectFactory
{
    /**
     * @param $name
     *
     * @return Project
     */
    public function create($name)
    {
        $project = new Project();
        $project->setProjectName($name);

        return $project;
    }
}
