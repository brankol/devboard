<?php
namespace DevBoard\Github\Commit;

/**
 * Class GithubState.
 *
 * Constants representing github commit state using Status API.
 */
class GithubState
{
    /**
     * @const
     */
    const PENDING = 'pending';

    /**
     * @const
     */
    const ERROR = 'error';

    /**
     * @const
     */
    const FAILURE = 'failure';

    /**
     * @const
     */
    const SUCCESS = 'success';
}
