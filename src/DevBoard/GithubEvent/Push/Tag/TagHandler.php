<?php
namespace DevBoard\GithubEvent\Push\Tag;

use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\Tag\GithubTagFacade;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Tag\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Tag\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Tag\Data\RepoFactory;
use DevBoard\GithubEvent\Push\Tag\Data\TagFactory;
use Doctrine\ORM\EntityManager;

/**
 * Class TagHandler.
 */
class TagHandler
{
    private $repoFactory;
    private $tagFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    private $githubRepoFacade;
    private $githubTagFacade;
    private $githubCommitFacade;
    private $githubUserFacade;
    private $em;

    /**
     * TagHandler constructor.
     *
     * @param RepoFactory            $repoFactory
     * @param TagFactory             $tagFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     * @param GithubRepoFacade       $githubRepoFacade
     * @param GithubTagFacade        $githubTagFacade
     * @param GithubCommitFacade     $githubCommitFacade
     * @param GithubUserFacade       $githubUserFacade
     * @param EntityManager          $em
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
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
        $this->repoFactory            = $repoFactory;
        $this->tagFactory             = $tagFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
        $this->githubRepoFacade       = $githubRepoFacade;
        $this->githubTagFacade        = $githubTagFacade;
        $this->githubCommitFacade     = $githubCommitFacade;
        $this->githubUserFacade       = $githubUserFacade;
        $this->em                     = $em;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     */
    public function create(PushPayload $pushPayload)
    {
        $repoValueObject = $this->repoFactory->create($pushPayload);
        $githubRepo      = $this->githubRepoFacade->getOrCreate($repoValueObject);

        $tagValueObject = $this->tagFactory->create($pushPayload);
        $githubTag      = $this->githubTagFacade->getOrCreate($githubRepo, $tagValueObject);

        $commitValueObject = $this->commitFactory->create($pushPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $commitAuthorValueObject = $this->commitAuthorFactory->create($pushPayload);
        $githubCommitAuthor      = $this->githubUserFacade->getOrCreate($commitAuthorValueObject);

        $commitCommitterValueObject = $this->commitCommitterFactory->create($pushPayload);
        $githubCommitCommitter      = $this->githubUserFacade->getOrCreate($commitCommitterValueObject);

        $githubCommit->setAuthor($githubCommitAuthor);
        $githubCommit->setCommitter($githubCommitCommitter);

        $githubTag->setLastCommit($githubCommit);

        $this->em->persist($githubTag);
        $this->em->persist($githubCommit);
        $this->em->flush();

        return true;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     */
    public function update(PushPayload $pushPayload)
    {
        $repoValueObject = $this->repoFactory->create($pushPayload);
        $githubRepo      = $this->githubRepoFacade->getOrCreate($repoValueObject);

        $tagValueObject = $this->tagFactory->create($pushPayload);
        $githubTag      = $this->githubTagFacade->getOrCreate($githubRepo, $tagValueObject);

        $commitValueObject = $this->commitFactory->create($pushPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $commitAuthorValueObject = $this->commitAuthorFactory->create($pushPayload);
        $githubCommitAuthor      = $this->githubUserFacade->getOrCreate($commitAuthorValueObject);

        $commitCommitterValueObject = $this->commitCommitterFactory->create($pushPayload);
        $githubCommitCommitter      = $this->githubUserFacade->getOrCreate($commitCommitterValueObject);

        $githubCommit->setAuthor($githubCommitAuthor);
        $githubCommit->setCommitter($githubCommitCommitter);

        $githubTag->setLastCommit($githubCommit);

        $this->em->persist($githubTag);
        $this->em->persist($githubCommit);
        $this->em->flush();

        return true;
    }

    /**
     * @param PushPayload $pushPayload
     *
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @TODO
     */
    public function delete(PushPayload $pushPayload)
    {
        $repoValueObject = $this->repoFactory->create($pushPayload);
        $githubRepo      = $this->githubRepoFacade->get($repoValueObject);

        $tagValueObject = $this->tagFactory->create($pushPayload);
        $githubTag      = $this->githubTagFacade->get($githubRepo, $tagValueObject);

        $this->em->remove($githubTag);
        $this->em->flush();

        return true;
    }
}
