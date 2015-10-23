<?php
namespace DevBoard\Behat\Github\User;

use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\User\GithubUser;
use Resources\Behat\DefaultContext;

/**
 * Class FixtureContext.
 */
class FixtureContext extends DefaultContext
{
    /**
     * @Given there is github user with username :username
     *
     * @param $username
     */
    public function thereIsGithubUserWithUsername($username)
    {
        $user = new GithubUser();

        $user->setUsername($username)
            ->setName('John Doe');

        $this->save($user);
    }

    /**
     * @Given there is github user with:
     *
     * @param TableNode $table
     */
    public function thereIsGithubUserWith(TableNode $table)
    {
        $user = new GithubUser();

        foreach ($table as $row) {
            $propertySetter = 'set'.lcfirst($row['property']);
            $user->$propertySetter($row['value']);
        }

        $this->save($user);
    }
}
