<?php
namespace spec\DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitStatusSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\CommitStatus\Entity\GithubCommitStatus');
    }

    public function it_has_commit_as_identifier(GithubCommit $githubCommit)
    {
        $this->setGithubCommit($githubCommit);
        $this->getGithubCommit()->shouldReturn($githubCommit);
    }

    public function it_has_external_service_as_identifier(GithubExternalService $githubExternalService)
    {
        $this->setGithubExternalService($githubExternalService);
        $this->getGithubExternalService()->shouldReturn($githubExternalService);
    }

    public function it_has_state()
    {
        $this->setState(GithubCommitStatusState::PENDING);
        $this->getState()->shouldReturn(GithubCommitStatusState::PENDING);
    }

    public function it_has_target_url()
    {
        $this->setTargetUrl('url');
        $this->getTargetUrl()->shouldReturn('url');
    }
}
