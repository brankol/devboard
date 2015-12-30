<?php
namespace DevBoard\Github\PullRequest;

/**
 * Class GithubPullRequestState.
 */
class GithubPullRequestState
{
    const WTF    = 0;
    const OPENED = 10;
    const CLOSED = 20;

    /**
     * @param $text
     *
     * @return int
     */
    public static function convert($text)
    {
        switch ($text) {
            case 'open':
                return self::OPENED;
            case 'closed':
                return self::CLOSED;
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

            case self::OPENED:
                return 'open';
            case self::CLOSED:
                return 'closed';
            case self::WTF:
                return 'wtf';
            default:
                return '???';
        }
    }
}
