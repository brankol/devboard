<?php
namespace spec\DevBoard\Github\CommitStatus\Entity;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitStatusFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\CommitStatus\Entity\GithubCommitStatusFactory');
    }

    public function it_will_create_new_entity(GithubCommit $githubCommit, GithubExternalService $githubExternalService)
    {
        $this->create($githubCommit, $githubExternalService)
            ->shouldReturnAnInstanceOf('DevBoard\Github\CommitStatus\Entity\GithubCommitStatus');
    }
}
