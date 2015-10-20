<?php
namespace DevBoard\Github\Commit;

/**
 * Class GithubStatus.
 *
 * Constants representing GithubCommit github status as integers of github state on commits using Status API.
 */
class GithubStatus
{
    /**
     * @const
     */
    const PENDING = 10;

    /**
     * @const
     */
    const ERROR = 30;

    /**
     * @const
     */
    const FAILURE = 40;

    /**
     * @const
     */
    const SUCCESS = 50;
}
