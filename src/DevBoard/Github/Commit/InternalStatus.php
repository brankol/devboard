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
     * @const Pending and success CI results.
     */
    const SUCCEEDING = 35;

    /**
     * @const At least one of the CI results erorred.
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

    public static function getText($value)
    {
        switch ($value) {
            case self::UNKNOWN:
                return 'Unknown';
            case self::PENDING:
                return 'Unknown';
            case self::SUCCEEDING:
                return 'Unknown';
            case self::ERROR:
                return 'Unknown';
            case self::FAILURE:
                return 'Unknown';
            case self::FINISHED_NO_STATUS_CHECKS:
                return 'Unknown';
            case self::SUCCESS:
                return 'Unknown';
            default:
                return '??';
        }
    }
}
