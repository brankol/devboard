<?php
namespace DevBoard\Github\Commit;

/**
 * Class InternalStatus.
 *
 * Constants representing GithubCommit internal status.
 */
class InternalStatus
{
    /**
     * @const Current internal status is unknown.
     */
    const UNKNOWN = 10;

    /**
     * @const Pending CI results.
     */
    const PENDING = 30;

    /**
     * @const All CI results not in but at least one of them already failed.
     */
    const FAILING = 40;

    /**
     * @const Error status
     */
    const ERROR = 60;

    /**
     * @const At least one of the CI results failed.
     */
    const FAILURE = 70;

    /**
     * @const There are no checks on status API but github status says pending.
     */
    const FINISHED_NO_STATUS_CHECKS = 80;

    /**
     * @const CI results were a success
     */
    const SUCCESS = 90;
}
