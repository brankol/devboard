<?php
namespace spec\DevBoard\Github\PullRequest;

use DevBoard\Github\PullRequest\Entity\GithubPullRequest;
use DevBoard\Github\PullRequest\Entity\GithubPullRequestFactory;
use DevBoard\Github\PullRequest\Entity\GithubPullRequestRepository;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\GithubRemote\ValueObject\PullRequest\PullRequest;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Github\PullRequest\GithubPullRequestFacade');
    }

    public function let(GithubPullRequestRepository $repository, GithubPullRequestFactory $factory, EntityManager $em)
    {
        $this->beConstructedWith($repository, $factory, $em);
    }

    public function it_will_retrieve_entity(
        $repository,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject,
        GithubPullRequest $githubPullRequestEntity
    ) {
        $pullRequestValueObject->getNumber()->willReturn('23');
        $repository->findOneByNumber($githubRepo, '23')->willReturn($githubPullRequestEntity);
        $this->get($githubRepo, $pullRequestValueObject)->shouldReturn($githubPullRequestEntity);
    }

    public function it_will_return_null_if_no_entity_found(
        $repository,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject
    ) {
        $pullRequestValueObject->getNumber()->willReturn('25');
        $repository->findOneByNumber($githubRepo, '25')->willReturn(null);
        $this->get($githubRepo, $pullRequestValueObject)->shouldReturn(null);
    }

    public function it_will_create_new_entity(
        $factory,
        $em,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject,
        GithubPullRequest $githubPullRequestEntity
    ) {
        $factory->createFromValueObject($githubRepo, $pullRequestValueObject)->willReturn($githubPullRequestEntity);

        $em->persist($githubPullRequestEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($githubRepo, $pullRequestValueObject)->shouldReturn($githubPullRequestEntity);
    }

    public function it_will_retrieve_entity_if_it_exists(
        $repository,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject,
        GithubPullRequest $githubPullRequestEntity
    ) {
        $pullRequestValueObject->getNumber()->willReturn('27');
        $repository->findOneByNumber($githubRepo, '27')->willReturn($githubPullRequestEntity);
        $this->getOrCreate($githubRepo, $pullRequestValueObject)->shouldReturn($githubPullRequestEntity);
    }

    public function it_will_return_new_entity_if_no_entity_found(
        $repository,
        $factory,
        $em,
        GithubRepo $githubRepo,
        PullRequest $pullRequestValueObject,
        GithubPullRequest $githubPullRequestEntity
    ) {
        $pullRequestValueObject->getNumber()->willReturn('31');
        $repository->findOneByNumber($githubRepo, '31')->willReturn(null);

        $factory->createFromValueObject($githubRepo, $pullRequestValueObject)->willReturn($githubPullRequestEntity);

        $em->persist($githubPullRequestEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->getOrCreate($githubRepo, $pullRequestValueObject)->shouldReturn($githubPullRequestEntity);
    }
}
