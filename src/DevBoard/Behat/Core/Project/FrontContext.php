<?php
namespace DevBoard\Behat\Core\Project;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Resources\Behat\CleanDbTrait;
use Resources\Behat\LoginWebTrait;
use Resources\Behat\Symfony2Trait;
use Resources\Behat\WebContext;

/**
 * Class FrontContext.
 */
class FrontContext extends WebContext implements KernelAwareContext, SnippetAcceptingContext
{
    use DataTrait;
    use ProjectValidationTrait;
    use Symfony2Trait;
    use LoginWebTrait;
    use CleanDbTrait;

    /**
     * @Given I am adding new project
     */
    public function iAmAddingNewProject()
    {
        $this->visitPath('/project/new');
    }

    /**
     * @Transform :property
     *
     * @param $propertyName
     *
     * @return string
     */
    public function transformPropertyNameIntoFormPropertyName($propertyName)
    {
        return 'form_'.lcfirst(str_replace(' ', '', $propertyName));
    }

    /**
     * @When I fill :property with :propertyValue
     *
     * @param $property
     * @param $propertyValue
     */
    public function iFillWith($property, $propertyValue)
    {
        $this->fillField($property, $propertyValue);
    }

    /**
     * @When I save changes
     */
    public function iSaveChanges()
    {
        $this->pressButton('Save');
    }
}
