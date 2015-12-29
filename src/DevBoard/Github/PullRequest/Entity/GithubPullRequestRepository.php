<?php
namespace DevBoard\Github\PullRequest\Entity;

use DevBoard\Github\PullRequest\GithubPullRequestState;
use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\ORM\EntityRepository;

/**
 * Class GithubPullRequestRepository.
 */
class GithubPullRequestRepository extends EntityRepository
{
    /**
     * @param GithubRepo $githubRepo
     * @param            $pullRequestNumber
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    public function findOneByNumber(GithubRepo $githubRepo, $pullRequestNumber)
    {
        return $this->findOneBy(
            [
                'number' => $pullRequestNumber,
                'repo'   => $githubRepo,
            ]
        );
    }

    /**
     * @param GithubRepo $githubRepo
     * @param            $pullRequestTitle
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    public function findOneByTitle(GithubRepo $githubRepo, $pullRequestTitle)
    {
        return $this->findOneBy(
            [
                'title' => $pullRequestTitle,
                'repo'  => $githubRepo,
            ]
        );
    }

    /**
     * @param $repoIds
     *
     * @return array
     */
    public function getPullRequestIdsFromRepoIds($repoIds)
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b.id')
            ->where('b.repo IN (:repoIds)')
            ->setParameter('repoIds', $repoIds);

        $rawResult = $queryBuilder->getQuery()->getArrayResult();

        $results = [];

        foreach ($rawResult as $result) {
            $results[] = $result['id'];
        }

        return $results;
    }

    /**
     * @param $repoIds
     *
     * @return array
     */
    public function getOpenPullRequestsFromRepoIds($repoIds)
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.lastCommit', 'c')
            ->where('b.repo IN (:repoIds)')
            ->andWhere('b.state = :state')
            ->setParameter('repoIds', $repoIds)
            ->setParameter('state', GithubPullRequestState::OPENED)
            ->orderBy('b.updatedAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param $repoIds
     *
     * @return array
     */
    public function getLivePullRequestsFromRepoIds($repoIds)
    {
        $timeLimit = new \DateTime();
        $timeLimit->modify('-60 min');

        $queryBuilder = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.lastCommit', 'c')
            ->where('b.repo IN (:repoIds)')
            ->andWhere('b.updatedAt > :timeLimit')
            ->andWhere('b.state = :state')
            ->setParameter('repoIds', $repoIds)
            ->setParameter('timeLimit', $timeLimit)
            ->setParameter('state', GithubPullRequestState::OPENED)
            ->orderBy('b.updatedAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}
