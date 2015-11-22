<?php
namespace DevBoard\Behat\NullDev\User;

use Behat\Behat\Context\SnippetAcceptingContext;
use Resources\Behat\DomainContext;

/**
 * Behat context class.
 */
class UserContext extends DomainContext implements SnippetAcceptingContext
{
    use DataTrait;

    /**
     * @Given there is no user on site with username :arg1
     *
     * @param $username
     */
    public function thereIsNoUserOnSiteWithUsername($username)
    {
        $user = $this->getUserRepository()->findOneByUsername($username);

        if ($user) {
            $this->delete($user);
        }
    }

    /**
     * @Given there is no user on site with email :arg1
     *
     * @param $email
     */
    public function thereIsNoUserOnSiteWithEmail($email)
    {
        $user = $this->getUserRepository()->findOneByEmail($email);

        if ($user) {
            $this->delete($user);
        }
    }

    /**
     * @Given there is a user with username :arg1
     *
     * @param $username
     *
     * @throws \Exception
     */
    public function thereIsUserWithUsername($username)
    {
        $user = $this->getUserRepository()->findOneByUsername($username);

        if (!$user) {
            $msg = "No user with username '$username' found";
            throw new \Exception($msg);
        }
    }

    /**
     * @Given there is a user with email :arg1
     *
     * @param $email
     *
     * @throws \Exception
     */
    public function thereIsUserWithEmail($email)
    {
        $user = $this->getUserRepository()->findOneByEmail($email);

        if (!$user) {
            $msg = "No user with email '$email' found";
            throw new \Exception($msg);
        }
    }

    /**
     * @When I fill in github test credentials
     */
    public function iFillInGithubTestCredentials()
    {
        $this->getSession()->getPage()->fillField('login_field', getenv('GITHUB_USERNAME'));
        $this->getSession()->getPage()->fillField('password', getenv('GITHUB_PASSWORD'));
    }
}
