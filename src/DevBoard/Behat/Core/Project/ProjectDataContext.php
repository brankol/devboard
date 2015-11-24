<?php
namespace DevBoard\Behat\Core\Project;

use Resources\Behat\DefaultContext;

/**
 * Class ProjectContext.
 */
class ProjectDataContext extends DefaultContext
{
    use DataTrait;
    use ProjectValidationTrait;

    /**
     * @Then there should be project with :projectName name in system
     *
     * @param $projectName
     *
     * @throws \Exception
     */
    public function thereShouldBeProjectWithNameInSystem($projectName)
    {
        $this->getProjectByName($projectName);
    }
}
