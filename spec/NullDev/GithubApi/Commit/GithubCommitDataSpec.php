<?php
namespace spec\NullDev\GithubApi\Commit;

use DateTime;
use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\User\GithubUserData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Commit\GithubCommitData');
    }

    public function let(
        GithubRepo $githubRepo,
        $sha,
        GithubUserData $author,
        DateTime $authorDate,
        GithubUserData $committer,
        DateTime $committerDate,
        $message,
        $githubStatus
    ) {
        $this->beConstructedWith(
            $githubRepo,
            $sha,
            $author,
            $authorDate,
            $committer,
            $committerDate,
            $message,
            $githubStatus
        );
    }
}
