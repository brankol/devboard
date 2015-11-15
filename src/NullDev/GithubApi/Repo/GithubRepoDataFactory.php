<?php
namespace NullDev\GithubApi\Repo;

use DateTime;

/**
 * Class GithubRepoDataFactory.
 */
class GithubRepoDataFactory
{
    /**
     * @param array $inputData
     *
     * @return GithubRepoData
     */
    public function create(array $inputData)
    {
        $githubId        = $inputData['id'];
        $owner           = $inputData['owner']['login'];
        $name            = $inputData['name'];
        $fullName        = $inputData['full_name'];
        $htmlUrl         = $inputData['html_url'];
        $description     = $inputData['description'];
        $fork            = $inputData['fork'];
        $defaultBranch   = $inputData['default_branch'];
        $githubPrivate   = $inputData['private'];
        $gitUrl          = $inputData['git_url'];
        $sshUrl          = $inputData['ssh_url'];
        $githubCreatedAt = new DateTime($inputData['created_at']);
        $githubUpdatedAt = new DateTime($inputData['updated_at']);
        $githubPushedAt  = new DateTime($inputData['pushed_at']);

        return new GithubRepoData(
            $githubId,
            $owner,
            $name,
            $fullName,
            $htmlUrl,
            $description,
            $fork,
            $defaultBranch,
            $githubPrivate,
            $gitUrl,
            $sshUrl,
            $githubCreatedAt,
            $githubUpdatedAt,
            $githubPushedAt

        );
    }
}
