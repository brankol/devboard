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

    /**
     * @param $value
     *
     * @return string
     */
    public static function getText($value)
    {
        switch ($value) {
            case self::UNKNOWN:
                return 'Unknown';
            case self::PENDING:
                return 'Pending';
            case self::SUCCEEDING:
                return 'Succeding';
            case self::ERROR:
                return 'Error';
            case self::FAILURE:
                return 'Failure';
            case self::FINISHED_NO_STATUS_CHECKS:
                return 'Finished';
            case self::SUCCESS:
                return 'Success';
            default:
                return '??';
        }
    }
}
