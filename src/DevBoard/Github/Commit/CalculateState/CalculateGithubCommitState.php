<?php
namespace DevBoard\Github\Commit\CalculateState;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\InternalStatus;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;

/**
 * Class CalculateGithubCommitState.
 */
class CalculateGithubCommitState
{
    /**
     * @param GithubCommit $githubCommit
     *
     * @return GithubCommit
     */
    public function calculate(GithubCommit $githubCommit)
    {
        if (0 == count($githubCommit->getCommitStatuses())) {
            $githubCommit->setInternalStatus(InternalStatus::FINISHED_NO_STATUS_CHECKS);
        } elseif ($this->allPassed($githubCommit)) {
            $githubCommit->setInternalStatus(InternalStatus::SUCCESS);
        } elseif ($this->anyErrored($githubCommit)) {
            $githubCommit->setInternalStatus(InternalStatus::ERROR);
        } elseif ($this->anyFailed($githubCommit)) {
            $githubCommit->setInternalStatus(InternalStatus::FAILURE);
        } elseif ($this->allPending($githubCommit)) {
            $githubCommit->setInternalStatus(InternalStatus::PENDING);
        } elseif ($this->isSucceeding($githubCommit)) {
            $githubCommit->setInternalStatus(InternalStatus::SUCCEEDING);
        } else {
            $githubCommit->setInternalStatus(InternalStatus::UNKNOWN);
        }

        return $githubCommit;
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return bool
     */
    private function allPassed(GithubCommit $githubCommit)
    {
        return $this->allEqualTo($githubCommit, [GithubCommitStatusState::PASSED]);
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return bool
     */
    private function anyErrored(GithubCommit $githubCommit)
    {
        return $this->anyEqualTo($githubCommit, [GithubCommitStatusState::ERROR]);
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return bool
     */
    private function anyFailed(GithubCommit $githubCommit)
    {
        return $this->anyEqualTo($githubCommit, [GithubCommitStatusState::FAILED]);
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return bool
     */
    private function allPending(GithubCommit $githubCommit)
    {
        return $this->allEqualTo($githubCommit, [GithubCommitStatusState::PENDING]);
    }

    /**
     * @param GithubCommit $githubCommit
     *
     * @return bool
     */
    private function isSucceeding(GithubCommit $githubCommit)
    {
        return $this->allEqualTo($githubCommit, [GithubCommitStatusState::PENDING, GithubCommitStatusState::PASSED]);
    }

    /**
     * @param GithubCommit $githubCommit
     * @param              $expectedStates
     *
     * @return bool
     */
    private function allEqualTo(GithubCommit $githubCommit, $expectedStates)
    {
        foreach ($githubCommit->getCommitStatuses() as $status) {
            if (!in_array($status->getState(), $expectedStates)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param GithubCommit $githubCommit
     * @param              $expectedStates
     *
     * @return bool
     */
    private function anyEqualTo(GithubCommit $githubCommit, $expectedStates)
    {
        foreach ($githubCommit->getCommitStatuses() as $status) {
            if (in_array($status->getState(), $expectedStates)) {
                return true;
            }
        }

        return false;
    }
}
