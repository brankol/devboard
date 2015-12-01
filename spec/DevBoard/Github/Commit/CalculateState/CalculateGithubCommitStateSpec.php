<?php
namespace spec\DevBoard\Github\Commit\CalculateState;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\InternalStatus;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatus;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalculateGithubCommitStateSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\CalculateState\CalculateGithubCommitState');
    }

    public function let()
    {
    }

    public function it_sets_internal_state_to_unknown_if_no_statuses(
        GithubCommit $githubCommit
    ) {
        $githubCommit->getCommitStatuses()->willReturn([]);
        $githubCommit->setInternalStatus(InternalStatus::FINISHED_NO_STATUS_CHECKS)->shouldBeCalled();

        $this->calculate($githubCommit)->shouldReturn($githubCommit);
    }

    public function it_sets_internal_state_to_pending_if_all_statuses_are_pending(
        GithubCommit $githubCommit,
        GithubCommitStatus $commitStatus1,
        GithubCommitStatus $commitStatus2,
        GithubCommitStatus $commitStatus3,
        GithubCommitStatus $commitStatus4
    ) {
        $commitStatusCollection = [$commitStatus1, $commitStatus2, $commitStatus3, $commitStatus4];

        $commitStatus1->getState()->willReturn(GithubCommitStatusState::PENDING);
        $commitStatus2->getState()->willReturn(GithubCommitStatusState::PENDING);
        $commitStatus3->getState()->willReturn(GithubCommitStatusState::PENDING);
        $commitStatus4->getState()->willReturn(GithubCommitStatusState::PENDING);

        $githubCommit->getCommitStatuses()->willReturn($commitStatusCollection);
        $githubCommit->setInternalStatus(InternalStatus::PENDING)->shouldBeCalled();

        $this->calculate($githubCommit)->shouldReturn($githubCommit);
    }

    public function it_sets_internal_state_to_failure_if_all_statuses_failed(
        GithubCommit $githubCommit,
        GithubCommitStatus $commitStatus1,
        GithubCommitStatus $commitStatus2,
        GithubCommitStatus $commitStatus3,
        GithubCommitStatus $commitStatus4
    ) {
        $commitStatusCollection = [$commitStatus1, $commitStatus2, $commitStatus3, $commitStatus4];

        $commitStatus1->getState()->willReturn(GithubCommitStatusState::FAILED);
        $commitStatus2->getState()->willReturn(GithubCommitStatusState::FAILED);
        $commitStatus3->getState()->willReturn(GithubCommitStatusState::FAILED);
        $commitStatus4->getState()->willReturn(GithubCommitStatusState::FAILED);

        $githubCommit->getCommitStatuses()->willReturn($commitStatusCollection);
        $githubCommit->setInternalStatus(InternalStatus::FAILURE)->shouldBeCalled();

        $this->calculate($githubCommit)->shouldReturn($githubCommit);
    }

    public function it_sets_internal_state_to_error_if_all_statuses_errorred(
        GithubCommit $githubCommit,
        GithubCommitStatus $commitStatus1,
        GithubCommitStatus $commitStatus2,
        GithubCommitStatus $commitStatus3,
        GithubCommitStatus $commitStatus4
    ) {
        $commitStatusCollection = [$commitStatus1, $commitStatus2, $commitStatus3, $commitStatus4];

        $commitStatus1->getState()->willReturn(GithubCommitStatusState::ERROR);
        $commitStatus2->getState()->willReturn(GithubCommitStatusState::ERROR);
        $commitStatus3->getState()->willReturn(GithubCommitStatusState::ERROR);
        $commitStatus4->getState()->willReturn(GithubCommitStatusState::ERROR);

        $githubCommit->getCommitStatuses()->willReturn($commitStatusCollection);
        $githubCommit->setInternalStatus(InternalStatus::ERROR)->shouldBeCalled();

        $this->calculate($githubCommit)->shouldReturn($githubCommit);
    }

    public function it_sets_internal_state_to_success_if_all_statuses_passed(
        GithubCommit $githubCommit,
        GithubCommitStatus $commitStatus1,
        GithubCommitStatus $commitStatus2,
        GithubCommitStatus $commitStatus3,
        GithubCommitStatus $commitStatus4
    ) {
        $commitStatusCollection = [$commitStatus1, $commitStatus2, $commitStatus3, $commitStatus4];

        $commitStatus1->getState()->willReturn(GithubCommitStatusState::PASSED);
        $commitStatus2->getState()->willReturn(GithubCommitStatusState::PASSED);
        $commitStatus3->getState()->willReturn(GithubCommitStatusState::PASSED);
        $commitStatus4->getState()->willReturn(GithubCommitStatusState::PASSED);

        $githubCommit->getCommitStatuses()->willReturn($commitStatusCollection);
        $githubCommit->setInternalStatus(InternalStatus::SUCCESS)->shouldBeCalled();

        $this->calculate($githubCommit)->shouldReturn($githubCommit);
    }
}
