<?php
namespace DevBoard\Behat\Github\Repo;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\Repo\Entity\GithubRepo;
use Resources\Behat\DomainContext;

/**
 * Class GithubRepoContext.
 */
class GithubRepoContext extends DomainContext
{
    use DataTrait;
    use GithubRepoValidationTrait;

    /**
     * @Given I am adding new github repo
     */
    public function iAmAddingNewGithubRepo()
    {
        $this->target = new GithubRepo();
    }

    /**
     * @When I fill in details for :fullName github repo
     *
     * @param $fullName
     */
    public function iFillInDetailsForGithubRepo($fullName)
    {
        $this->target = $this->fillRepoWithDetails($this->target, $fullName);
    }

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
