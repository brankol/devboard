<?php
namespace DevBoard\Behat\Github\User;

use DevBoard\Github\User\Entity\GithubUser;
use Exception;
use Resources\Behat\DomainContext;

/**
 * Class GithubUserContext.
 */
class GithubUserContext extends DomainContext
{
    use DataTrait;
    use GithubUserValidationTrait;

    private $service;

    private $error;

    /**
     * @Given I am fetching remote user data from Github
     */
    public function iAmFetchingRemoteUserDataFromGithub()
    {
        $this->setupGithubApiUserService();
    }

    /**
     * @Given I am adding new github user
     */
    public function iAmAddingNewGithubUser()
    {
        $this->target = new GithubUser();
    }

    /**
     * @When I look for details on :username
     *
     * @param string $username
     */
    public function iLookForDetailsOn($username)
    {
        $this->fetchRemoteUserDetailsFor($username);
    }

    /**
     * @When I create :username github user
     *
     * @param $username
     */
    public function iCreateGithubUser($username)
    {
        $service = $this->getService('github.user.service');

        try {
            $this->target = $service->create($username, $this->getCurrentUser());
        } catch (Exception $exception) {
            $this->error = $exception;
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
     * @Then I will get user details
     */
    public function iWillGetUserDetails()
    {
        if (null !== $this->error) {
            throw new Exception('No error was expected!');
        }
        if (null === $this->target) {
            throw new Exception('Some remote data was expected but none found');
        }
    }

    /**
     * @Then I will get an error that user doesnt exist
     */
    public function iWillGetAnErrorThatUserDoesntExist()
    {
        if (null === $this->error) {
            throw new Exception('An error was expected but none found');
        }

        if ('Github\Exception\RuntimeException' !== get_class($this->error)) {
            throw new Exception('Expected Github\Exception\RuntimeException error');
        }

        if ('Not Found' !== $this->error->getMessage()) {
            throw new Exception('Expected exception with "Not Found" message.');
        }
    }

    private function setupGithubApiUserService()
    {
        $this->service = $this->getService('null_dev_github_api.user.service');
    }

    /**
     * @param $username
     */
    private function fetchRemoteUserDetailsFor($username)
    {
        $githubUser = $this->createUserObjectFromUsername($username);

        try {
            $this->target = $this->service->fetch($githubUser, $this->getCurrentUser());
        } catch (Exception $exception) {
            $this->error = $exception;
        }
    }
}
