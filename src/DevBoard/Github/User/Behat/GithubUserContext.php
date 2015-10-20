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
