<?php
namespace DevBoard\Github\User\Behat;

/**
 * Class GithubUserValidationTrait.
 */
trait GithubUserValidationTrait
{
    /**
     * @Then I should see validation error that username already in use
     */
    public function iShouldSeeValidationErrorThatUsernameAlreadyInUse()
    {
        $this->assertHasValidationError('username', 'This value is already used.');
    }

    /**
     * @Then I should see validation error that githubId already in use
     */
    public function iShouldSeeValidationErrorThatGithubIdAlreadyInUse()
    {
        $this->assertHasValidationError('githubId', 'This value is already used.');
    }

    /**
     * @Then I should see validation error that email already in use
     */
    public function iShouldSeeValidationErrorThatEmailAlreadyInUse()
    {
        $this->assertHasValidationError('email', 'This value is already used.');
    }
}
