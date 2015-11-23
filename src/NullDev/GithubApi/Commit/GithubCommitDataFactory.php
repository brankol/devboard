<?php
namespace NullDev\GithubApi\Commit;

use DateTime;
use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\User\GithubUserDataFactory;

/**
 * Class GithubCommitDataFactory.
 */
class GithubCommitDataFactory
{
    private $githubUserDataFactory;

    /**
     * GithubCommitDataFactory constructor.
     *
     * @param GithubUserDataFactory $githubUserDataFactory
     */
    public function __construct(GithubUserDataFactory $githubUserDataFactory)
    {
        $this->githubUserDataFactory = $githubUserDataFactory;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param array      $inputData
     *
     * @return GithubCommitData
     */
    public function create(GithubRepo $githubRepo, array $inputData)
    {
        $sha    = null;
        $author = $this->githubUserDataFactory->create($inputData['author']);

        $authorDate = new DateTime($inputData['commit']['author']['date']);

        $committer = $this->githubUserDataFactory->create($inputData['committer']);

        $committerDate = new DateTime($inputData['commit']['committer']['date']);

        $message      = null;
        $githubStatus = null;

        return new GithubCommitData(
            $githubRepo,
            $sha,
            $author,
            $authorDate,
            $committer,
            $committerDate,
            $message,
            $githubStatus
        );
    }
}
