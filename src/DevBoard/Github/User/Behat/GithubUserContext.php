<?php
namespace DevBoard\Github\User\Behat;

use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\User\GithubUser;
use Resources\Behat\DomainContext;

/**
 * Class GithubUserContext.
 */
class GithubUserContext extends DomainContext
{
    use DataTrait;
    use GithubUserValidationTrait;

    /**
     * @Given I am adding new github user
     */
    public function iAmAddingNewGithubUser()
    {
        $this->target = new GithubUser();
    }

    /**
     * @When I fill in:
     *
     * @param TableNode $table
     */
    public function iFillIn(TableNode $table)
    {
        foreach ($table as $row) {
            $propertySetter = 'set'.lcfirst($row['property']);
            $this->target->$propertySetter($row['value']);
        }
    }

    /**
     * @Then there should be user with :username username in system
     *
     * @param $username
     */
    public function thereShouldBeUserWithUsernameInSystem($username)
    {
        $this->getGithubUserByUsername($username);
    }

    /**
     * @Then there should be user with :name name in system
     *
     * @param $name
     *
     * @throws \Exception
     */
    public function thereShouldBeUserWithNameInSystem($name)
    {
        $this->getGithubUserByName($name);
    }
}
