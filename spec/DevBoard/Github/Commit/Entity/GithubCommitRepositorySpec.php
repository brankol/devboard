<?php
namespace spec\DevBoard\Github\Commit\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitRepositorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Commit\Entity\GithubCommitRepository');
    }

    public function let(EntityManager $em, ClassMetadata $classMetadata)
    {
        $this->beConstructedWith($em, $classMetadata);
    }
}
