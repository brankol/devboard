<?php
namespace spec\DevBoard\Github\PullRequest\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestRepositorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\Entity\GithubPullRequestRepository');
    }

    public function let(EntityManager $em, ClassMetadata $classMetadata)
    {
        $this->beConstructedWith($em, $classMetadata);
    }
}
