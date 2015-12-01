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

    const ERROR = 70;

    const PASSED = 90;

    /**
     * @param $text
     *
     * @return int
     */
    public static function convert($text)
    {
        switch ($text) {
            case 'pending':
                return self::PENDING;
            case 'error':
                return self::ERROR;
            case 'failure':
                return self::FAILED;
            case 'success':
                return self::PASSED;
            default:
                return self::WTF;
        }
    }

    /**
     * @param $value
     *
     * @return string
     */
    public static function getText($value)
    {
        switch ($value) {

            case self::PENDING:
                return 'pending';
            case self::ERROR:
                return 'error';
            case self::FAILED:
                return 'failure';
            case self::PASSED:
                return 'success';
            case self::WTF:
                return 'wtf';
            default:
                return '???';
        }
    }
}
