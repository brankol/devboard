<?php
namespace DevBoard\GithubEvent\Push\Branch;

use DevBoard\Github\Branch\GithubBranchFacade;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\GithubRepoFacade;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubEvent\Payload\PushPayload;
use DevBoard\GithubEvent\Push\Branch\Data\BranchFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubEvent\Push\Branch\Data\CommitFactory;
use DevBoard\GithubEvent\Push\Branch\Data\RepoFactory;
use Doctrine\ORM\EntityManager;

/**
 * Class BranchHandler.
 */
class BranchHandler
{
    private $repoFactory;
    private $branchFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    private $githubRepoFacade;
    private $githubBranchFacade;
    private $githubCommitFacade;
    private $githubUserFacade;
    private $em;

    /**
     * BranchHandler constructor.
     *
     * @param RepoFactory            $repoFactory
     * @param BranchFactory          $branchFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     * @param GithubRepoFacade       $githubRepoFacade
     * @param GithubBranchFacade     $githubBranchFacade
     * @param GithubCommitFacade     $githubCommitFacade
     * @param GithubUserFacade       $githubUserFacade
     * @param EntityManager          $em
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        RepoFactory $repoFactory,
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory,
        GithubRepoFacade $githubRepoFacade,
        GithubBranchFacade $githubBranchFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em
    ) {
        $this->repoFactory            = $repoFactory;
        $this->branchFactory          = $branchFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
        $this->githubRepoFacade       = $githubRepoFacade;
        $this->githubBranchFacade     = $githubBranchFacade;
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

        $branchValueObject = $this->branchFactory->create($pushPayload);
        $githubBranch      = $this->githubBranchFacade->getOrCreate($githubRepo, $branchValueObject);

        $commitValueObject = $this->commitFactory->create($pushPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $commitAuthorValueObject = $this->commitAuthorFactory->create($pushPayload);
        $githubCommitAuthor      = $this->githubUserFacade->getOrCreate($commitAuthorValueObject);

        $commitCommitterValueObject = $this->commitCommitterFactory->create($pushPayload);
        $githubCommitCommitter      = $this->githubUserFacade->getOrCreate($commitCommitterValueObject);

        $githubCommit->setAuthor($githubCommitAuthor);
        $githubCommit->setCommitter($githubCommitCommitter);

        $githubBranch->setLastCommit($githubCommit);

        $this->em->persist($githubBranch);
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

        $branchValueObject = $this->branchFactory->create($pushPayload);
        $githubBranch      = $this->githubBranchFacade->getOrCreate($githubRepo, $branchValueObject);

        $commitValueObject = $this->commitFactory->create($pushPayload);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $commitAuthorValueObject = $this->commitAuthorFactory->create($pushPayload);
        $githubCommitAuthor      = $this->githubUserFacade->getOrCreate($commitAuthorValueObject);

        $commitCommitterValueObject = $this->commitCommitterFactory->create($pushPayload);
        $githubCommitCommitter      = $this->githubUserFacade->getOrCreate($commitCommitterValueObject);

        $githubCommit->setAuthor($githubCommitAuthor);
        $githubCommit->setCommitter($githubCommitCommitter);

        $githubBranch->setLastCommit($githubCommit);

        $this->em->persist($githubBranch);
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

        $branchValueObject = $this->branchFactory->create($pushPayload);
        $githubBranch      = $this->githubBranchFacade->get($githubRepo, $branchValueObject);

        $this->em->remove($githubBranch);
        $this->em->flush();

        return true;
    }
}
