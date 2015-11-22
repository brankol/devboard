<?php
namespace DevBoard\Behat\Github\User;

use Resources\Behat\DefaultContext;

/**
 * Class GithubUserDataContext.
 */
class GithubUserDataContext extends DefaultContext
{
    use DataTrait;

    /**
     * @Then there should be github user with username :username
     *
     * @param $username
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubUserWithUsername($username)
    {
        $this->getGithubUserByUsername($username);
    }

    /**
     * @Then there should be no github user with username :username
     *
     * @param $username
     *
     * @throws \Exception
     *
     * @return
     */
    public function thereShouldBeNoGithubUserWithUsername($username)
    {
        $user = $this->getGithubUserRepository()->findOneByUsername($username);

        if ($user) {
            throw new \Exception('We found github user with username:'.$username);
        }

        return $user;
    }
}
