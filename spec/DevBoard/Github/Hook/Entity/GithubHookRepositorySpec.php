<?php
namespace spec\DevBoard\Github\Hook\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubHookRepositorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\Hook\Entity\GithubHookRepository');
    }

    public function let(EntityManager $em, ClassMetadata $classMetadata)
    {
        $this->beConstructedWith($em, $classMetadata);
    }
}
