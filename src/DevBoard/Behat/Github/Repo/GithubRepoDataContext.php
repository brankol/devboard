<?php
namespace DevBoard\Behat\Github\Repo;

use Exception;
use Resources\Behat\DefaultContext;

/**
 * Class GithubRepoDataContext.
 */
class GithubRepoDataContext extends DefaultContext
{
    use DataTrait;
    use GithubRepoValidationTrait;

    /**
     * @Then there should be github repo with :fullName as full name in system
     *
     * @param $fullName
     *
     * @throws \Exception
     */
    public function thereShouldBeGithubRepoWithAsFullNameInSystem($fullName)
    {
        $this->getGithubRepoByFullName($fullName);
    }
}
