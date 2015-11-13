<?php
namespace spec\DevBoard\Github\Commit;

use DateTime;
use DevBoard\Github\Commit\GithubStatus;
use DevBoard\Github\Commit\InternalStatus;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\Entity\GithubUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\GithubCommit');
    }

    public function it_has_local_commit_id()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_github_repo_as_identifier(GithubRepo $githubRepo)
    {
        $this->setGithubRepo($githubRepo);
        $this->getGithubRepo()->shouldReturn($githubRepo);
    }

    public function it_has_commit_sha()
    {
        $this->setSha('sha');
        $this->getSha()->shouldReturn('sha');
    }

    public function it_has_author_relation(GithubUser $author)
    {
        $this->setAuthor($author);
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_has_author_date(DateTime $dateTime)
    {
        $this->setAuthorDate($dateTime);
        $this->getAuthorDate()->shouldReturn($dateTime);
    }

    public function it_has_committer_relation(GithubUser $committer)
    {
        $this->setCommitter($committer);
        $this->getCommitter()->shouldReturn($committer);
    }

    public function it_has_committer_date(DateTime $dateTime)
    {
        $this->setCommitterDate($dateTime);
        $this->getCommitterDate()->shouldReturn($dateTime);
    }

    public function it_has_commit_message()
    {
        $this->setMessage('Message');
        $this->getMessage()->shouldReturn('Message');
    }

    public function it_has_internal_status()
    {
        $this->setInternalStatus(InternalStatus::PENDING);
        $this->getInternalStatus()->shouldReturn(InternalStatus::PENDING);
    }

    public function it_has_github_status()
    {
        $this->setGithubStatus(GithubStatus::PENDING);
        $this->getGithubStatus()->shouldReturn(GithubStatus::PENDING);
    }

    public function it_holds_when_commit_was_created_locally(DateTime $created)
    {
        $this->setCreatedAt($created);
        $this->getCreatedAt()->shouldReturn($created);
    }

    public function it_holds_when_commit_was_last_updated_locally(DateTime $updated)
    {
        $this->setUpdatedAt($updated);
        $this->getUpdatedAt()->shouldReturn($updated);
    }
    public function it_sets_created_and_updated_datetimes_when_creating_github_commit()
    {
        $this->getCreatedAt()->shouldReturn(null);
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doCreatedValue();
        $this->getCreatedAt()->shouldReturnAnInstanceOf('DateTime');
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_sets_updated_datetimes_when_github_commit_is_changed()
    {
        $this->getUpdatedAt()->shouldReturn(null);
        $this->doUpdatedValue();
        $this->getUpdatedAt()->shouldReturnAnInstanceOf('DateTime');
    }

    public function it_will_return_message_as_default_string($message = 'Some message')
    {
        $this->setMessage($message);
        $this->__toString()->shouldReturn($message);
    }
}
