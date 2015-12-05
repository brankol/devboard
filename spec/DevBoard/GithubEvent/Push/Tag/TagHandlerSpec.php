<?php
namespace spec\DevBoard\GithubEvent\Push\Tag;

use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\Tag\Entity\GithubTag;
use DevBoard\Github\Tag\GithubTagFacade;
use DevBoard\Github\User\Entity\GithubUser;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Tag\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Tag\Data\RepoFactory;
use DevBoard\GithubEvent\Push\Tag\Data\TagFactory;
use DevBoard\GithubRemote\ValueObject\Commit\Commit;
use DevBoard\GithubRemote\ValueObject\Repo\Repo;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;
use DevBoard\GithubRemote\ValueObject\User\CommitAuthor;
use DevBoard\GithubRemote\ValueObject\User\CommitCommitter;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Push\Tag\TagHandler');
    }

    public function let(
        RepoFactory $repoFactory,
        TagFactory $tagFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubTagFacade $githubTagFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em

    ) {
        $this->beConstructedWith(
            $repoFactory,
            $tagFactory,
            $commitFactory,
            $commitAuthorFactory,
            $commitCommitterFactory,
            $githubRepoFacade,
            $githubTagFacade,
            $githubCommitFacade,
            $githubUserFacade,
            $em
        );
    }

    public function it_will_create(

        $repoFactory,
        $tagFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        $githubRepoFacade,
        $githubTagFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
        Tag $tagValueObject,
        Commit $commitValueObject,
        CommitAuthor $commitAuthorValueObject,
        CommitCommitter $commitCommitterValueObject,
        GithubRepo $githubRepoEntity,
        GithubTag $githubTagEntity,
        GithubCommit $githubCommitEntity,
        GithubUser $authorEntity,
        GithubUser $committerEntity
    ) {
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $tagFactory->create($pushPayload)->willReturn($tagValueObject);
        $commitFactory->create($pushPayload)->willReturn($commitValueObject);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthorValueObject);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitterValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
        $githubTagFacade->getOrCreate($githubRepoEntity, $tagValueObject)->willReturn($githubTagEntity);
        $githubCommitFacade->getOrCreate($githubRepoEntity, $commitValueObject)->willReturn($githubCommitEntity);
        $githubUserFacade->getOrCreate($commitAuthorValueObject)->willReturn($authorEntity);
        $githubUserFacade->getOrCreate($commitCommitterValueObject)->willReturn($committerEntity);

        $githubCommitEntity->setAuthor($authorEntity)->shouldBeCalled();
        $githubCommitEntity->setCommitter($committerEntity)->shouldBeCalled();

        $githubTagEntity->setLastCommit($githubCommitEntity)->shouldBeCalled();

        $em->persist($githubTagEntity)->shouldBeCalled();
        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->create($pushPayload)->shouldReturn(true);
    }

    public function it_will_update(
        $repoFactory,
        $tagFactory,
        $commitFactory,
        $commitAuthorFactory,
        $commitCommitterFactory,
        $githubRepoFacade,
        $githubTagFacade,
        $githubCommitFacade,
        $githubUserFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
        Tag $tagValueObject,
        Commit $commitValueObject,
        CommitAuthor $commitAuthorValueObject,
        CommitCommitter $commitCommitterValueObject,
        GithubRepo $githubRepoEntity,
        GithubTag $githubTagEntity,
        GithubCommit $githubCommitEntity,
        GithubUser $authorEntity,
        GithubUser $committerEntity
    ) {
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $tagFactory->create($pushPayload)->willReturn($tagValueObject);
        $commitFactory->create($pushPayload)->willReturn($commitValueObject);
        $commitAuthorFactory->create($pushPayload)->willReturn($commitAuthorValueObject);
        $commitCommitterFactory->create($pushPayload)->willReturn($commitCommitterValueObject);

        $githubRepoFacade->getOrCreate($repoValueObject)->willReturn($githubRepoEntity);
        $githubTagFacade->getOrCreate($githubRepoEntity, $tagValueObject)->willReturn($githubTagEntity);
        $githubCommitFacade->getOrCreate($githubRepoEntity, $commitValueObject)->willReturn($githubCommitEntity);
        $githubUserFacade->getOrCreate($commitAuthorValueObject)->willReturn($authorEntity);
        $githubUserFacade->getOrCreate($commitCommitterValueObject)->willReturn($committerEntity);

        $githubCommitEntity->setAuthor($authorEntity)->shouldBeCalled();
        $githubCommitEntity->setCommitter($committerEntity)->shouldBeCalled();

        $githubTagEntity->setLastCommit($githubCommitEntity)->shouldBeCalled();

        $em->persist($githubTagEntity)->shouldBeCalled();
        $em->persist($githubCommitEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->update($pushPayload)->shouldReturn(true);
    }

    public function it_will_delete(
        $repoFactory,
        $tagFactory,
        $githubRepoFacade,
        $githubTagFacade,
        $em,
        PushPayload $pushPayload,
        Repo $repoValueObject,
        Tag $tagValueObject,
        GithubRepo $githubRepoEntity,
        GithubTag $githubTagEntity
    ) {
        $repoFactory->create($pushPayload)->willReturn($repoValueObject);
        $tagFactory->create($pushPayload)->willReturn($tagValueObject);

        $githubRepoFacade->get($repoValueObject)->willReturn($githubRepoEntity);
        $githubTagFacade->get($githubRepoEntity, $tagValueObject)->willReturn($githubTagEntity);

        $em->remove($githubTagEntity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->delete($pushPayload)->shouldReturn(true);
    }
}
