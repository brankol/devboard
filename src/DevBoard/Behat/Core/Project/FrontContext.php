<?php
namespace DevBoard\Behat\Core\Project;

use Behat\Behat\Context\SnippetAcceptingContext;
use Resources\Behat\CleanDbTrait;
use Resources\Behat\WebContext;

/**
 * Class FrontContext.
 */
class FrontContext extends WebContext implements SnippetAcceptingContext
{
    use DataTrait;
    use ProjectValidationTrait;
    use CleanDbTrait;

    /**
     * @Given I am adding new project
     */
    public function iAmAddingNewProject()
    {
        $this->visitPath('/my/project/new');
    }

    /**
     * @When I save changes
     */
    public function iSaveChanges()
    {
        $this->pressButton('Save');
    }
}
