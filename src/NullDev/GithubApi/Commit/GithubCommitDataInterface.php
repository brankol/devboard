<?php
namespace NullDev\GithubApi\Commit;

/**
 * Interface GithubCommitDataInterface.
 */
interface GithubCommitDataInterface
{
    public function getSha();

    public function getAuthorDate();

    public function getCommitterDate();

    public function getMessage();
}
