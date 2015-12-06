<?php
namespace DevBoard\Github\PullRequest;

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
            case 'opened':
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
                return 'opened';
            case self::CLOSED:
                return 'closed';
            case self::WTF:
                return 'wtf';
            default:
                return '???';
        }
    }
}
