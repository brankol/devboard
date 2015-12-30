<?php
namespace DevBoard\Github\Hook\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;

/**
 * Class GithubHookFactory.
 */
class GithubHookFactory
{
    /**
     * GithubHookFactory constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param GithubRepo $githubRepo
     *
     * @return GithubHook
     */
    public function create(GithubRepo $githubRepo)
    {
        $githubHook = new GithubHook();
        $githubHook->setRepo($githubRepo);

        return $githubHook;
    }
}
