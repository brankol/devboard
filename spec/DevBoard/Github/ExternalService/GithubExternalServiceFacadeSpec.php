<?php
namespace spec\DevBoard\Github\ExternalService;

use DevBoard\Github\ExternalService\Entity\GithubExternalService;
use DevBoard\Github\ExternalService\Entity\GithubExternalServiceFactory;
use DevBoard\Github\ExternalService\Entity\GithubExternalServiceRepository;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubExternalServiceFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\ExternalService\GithubExternalServiceFacade');
    }

    public function let(
        GithubExternalServiceRepository $repository,
        GithubExternalServiceFactory $factory,
        EntityManager $em
    ) {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity($repository, GithubExternalService $githubExternalService)
    {
        $repository->findOneByContext('external-service-context')->willReturn($githubExternalService);

        $this->get('external-service-context')->shouldReturn($githubExternalService);
    }

    public function it_will_return_null_if_no_entity_found($repository)
    {
        $repository->findOneByContext('external-service-context')->willReturn(null);

        $this->get('external-service-context')->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubExternalService $githubExternalService
    ) {
        $factory->createFromContext('external-service-context')->willReturn($githubExternalService);

        $em->persist($githubExternalService)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create('external-service-context')->shouldReturn($githubExternalService);
    }

    public function it_will_retrieve_entity_if_it_exists($repository, GithubExternalService $githubExternalService)
    {
        $repository->findOneByContext('external-service-context')->willReturn($githubExternalService);

        $this->getOrCreate('external-service-context')->shouldReturn($githubExternalService);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubExternalService $githubExternalService
    ) {
        $repository->findOneByContext('external-service-context')->willReturn(null);
        $factory->createFromContext('external-service-context')->willReturn($githubExternalService);

        $em->persist($githubExternalService)->shouldBeCalled();
        $em->flush()->shouldBeCalled();
        $this->getOrCreate('external-service-context')->shouldReturn($githubExternalService);
    }
}
