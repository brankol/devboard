<?php
namespace DevBoard\Github\CommitStatus;

/**
 * Class GithubCommitStatusState.
 */
class GithubCommitStatusState
{
    const WTF = 4;

    const PENDING = 10;

    const FAILED = 60;

    const PASSED = 90;

    public static function convert($text)
    {
        switch ($text) {
            case 'pending':
                return self::PENDING;
            case 'failed':
                return self::FAILED;
            case 'success':
                return self::PASSED;
            default:
                return self::WTF;
        }
    }
}
