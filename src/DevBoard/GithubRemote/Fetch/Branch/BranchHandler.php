<?php
namespace DevBoard\GithubRemote\Fetch\Branch;

use DevBoard\Github\Branch\GithubBranchFacade;
use DevBoard\Github\Commit\GithubCommitFacade;
use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\User\GithubUserFacade;
use DevBoard\GithubRemote\Fetch\Branch\Data\BranchFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitAuthorFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitCommitterFactory;
use DevBoard\GithubRemote\Fetch\Branch\Data\CommitFactory;
use Doctrine\ORM\EntityManager;
use NullDev\GithubApi\Branch\GithubBranchData;

/**
 * Class BranchHandler.
 */
class BranchHandler
{
    private $branchFactory;
    private $commitFactory;
    private $commitAuthorFactory;
    private $commitCommitterFactory;

    private $githubBranchFacade;
    private $githubCommitFacade;
    private $githubUserFacade;
    private $em;

    /**
     * BranchHandler constructor.
     *
     * @param BranchFactory          $branchFactory
     * @param CommitFactory          $commitFactory
     * @param CommitAuthorFactory    $commitAuthorFactory
     * @param CommitCommitterFactory $commitCommitterFactory
     * @param GithubBranchFacade     $githubBranchFacade
     * @param GithubCommitFacade     $githubCommitFacade
     * @param GithubUserFacade       $githubUserFacade
     * @param EntityManager          $em
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        BranchFactory $branchFactory,
        CommitFactory $commitFactory,
        CommitAuthorFactory $commitAuthorFactory,
        CommitCommitterFactory $commitCommitterFactory,
        GithubBranchFacade $githubBranchFacade,
        GithubCommitFacade $githubCommitFacade,
        GithubUserFacade $githubUserFacade,
        EntityManager $em
    ) {
        $this->branchFactory          = $branchFactory;
        $this->commitFactory          = $commitFactory;
        $this->commitAuthorFactory    = $commitAuthorFactory;
        $this->commitCommitterFactory = $commitCommitterFactory;
        $this->githubBranchFacade     = $githubBranchFacade;
        $this->githubCommitFacade     = $githubCommitFacade;
        $this->githubUserFacade       = $githubUserFacade;
        $this->em                     = $em;
    }

    /**
     * @param GithubRepo       $githubRepo
     * @param GithubBranchData $githubBranchData
     *
     * @return bool
     */
    public function createOrUpdate(GithubRepo $githubRepo, GithubBranchData $githubBranchData)
    {
        $branchValueObject = $this->branchFactory->create($githubBranchData);
        $githubBranch      = $this->githubBranchFacade->getOrCreate($githubRepo, $branchValueObject);

        $commitValueObject = $this->commitFactory->create($githubBranchData);
        $githubCommit      = $this->githubCommitFacade->getOrCreate($githubRepo, $commitValueObject);

        $commitAuthorValueObject = $this->commitAuthorFactory->create($githubBranchData);
        $githubCommitAuthor      = $this->githubUserFacade->getOrCreate($commitAuthorValueObject);

        $commitCommitterValueObject = $this->commitCommitterFactory->create($githubBranchData);
        $githubCommitCommitter      = $this->githubUserFacade->getOrCreate($commitCommitterValueObject);

        $githubCommit->setAuthor($githubCommitAuthor);
        $githubCommit->setCommitter($githubCommitCommitter);

        $githubBranch->setLastCommit($githubCommit);

        $this->em->persist($githubBranch);
        $this->em->persist($githubCommit);
        $this->em->flush();

        return true;
    }
}
