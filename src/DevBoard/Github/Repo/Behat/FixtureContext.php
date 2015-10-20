<?php
namespace DevBoard\Github\Repo\Behat;

use Behat\Gherkin\Node\TableNode;
use DevBoard\Github\Repo\GithubRepo;
use Resources\Behat\DefaultContext;

/**
 * Class FixtureContext.
 */
class FixtureContext extends DefaultContext
{
    use DataTrait;

    /**
     * @Given there is :fullName github repo
     *
     * @param $fullName
     */
    public function thereIsGithubRepo($fullName)
    {
        $repo = new GithubRepo();

        $repo = $this->fillRepoWithDetails($repo, $fullName);

        $this->save($repo);
    }
}
