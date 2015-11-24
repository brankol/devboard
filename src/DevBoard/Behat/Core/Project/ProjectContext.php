<?php
namespace DevBoard\Behat\Core\Project;

use DevBoard\Core\Project\Entity\Project;
use Resources\Behat\DomainContext;

/**
 * Class ProjectContext.
 */
class ProjectContext extends DomainContext
{
    use DataTrait;
    use ProjectValidationTrait;

    /**
     * @Given I am adding new project
     */
    public function iAmAddingNewProject()
    {
        $this->target = new Project();
    }

    public function iSaveChanges()
    {
        $service = $this->getService('core.project.create.handler');

        $project = $service->create($this->target->getProjectName());

        echo $project->getProjectName();
    }
}
