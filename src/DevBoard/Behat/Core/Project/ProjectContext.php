<?php
namespace DevBoard\Behat\Core\Project;

use Behat\Gherkin\Node\TableNode;
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
