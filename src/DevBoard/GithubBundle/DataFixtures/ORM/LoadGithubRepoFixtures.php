<?php
namespace DevBoard\GithubBundle\DataFixtures\ORM;

use DevBoard\Github\Repo\Entity\GithubRepo;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadGithubRepoFixtures.
 */
class LoadGithubRepoFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $assassinRepo = $this->getPublicMasterRepo();
        $hitmanRepo   = $this->getPublicMasterRepo();
        $mermaidRepo  = $this->getPublicMasterRepo();

        $assassinRepo->setGithubId(41173461)
            ->setOwner('devboard')
            ->setName('test-assassin')
            ->setFullName('devboard/test-assassin')
            ->setHtmlUrl('https://github.com/devboard/test-assassin')
            ->setDefaultBranch('master')
            ->setGitUrl('git://github.com/devboard/test-assassin.git')
            ->setSshUrl('git@github.com:devboard/test-assassin.git');

        $hitmanRepo->setGithubId(41173477)
            ->setOwner('devboard')
            ->setName('test-hitman')
            ->setFullName('devboard/test-hitman')
            ->setHtmlUrl('https://github.com/devboard/test-hitman')
            ->setDefaultBranch('master')
            ->setGitUrl('git://github.com/devboard/test-hitman.git')
            ->setSshUrl('git@github.com:devboard/test-hitman.git');

        $mermaidRepo->setGithubId(49866075)
            ->setOwner('devboard')
            ->setName('test-mermaid')
            ->setFullName('devboard/test-mermaid')
            ->setHtmlUrl('https://github.com/devboard/test-mermaid')
            ->setDefaultBranch('master')
            ->setGitUrl('git://github.com/devboard/test-mermaid.git')
            ->setSshUrl('git@github.com:devboard/test-mermaid.git');

        $manager->persist($assassinRepo);
        $manager->persist($hitmanRepo);
        $manager->persist($mermaidRepo);
        $manager->flush();

        $this->addReference('gh-repo-devboard/test-assassin', $assassinRepo);
        $this->addReference('gh-repo-devboard/test-hitman', $hitmanRepo);
        $this->addReference('gh-repo-devboard/test-mermaid', $mermaidRepo);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * @return GithubRepo
     */
    private function getPublicMasterRepo()
    {
        $repo = new GithubRepo();
        $repo
            ->setDescription('..')
            ->setFork(0)
            ->setDefaultBranch('master')
            ->setGithubPrivate(0)
            ->setGithubCreatedAt(new \DateTime())
            ->setGithubUpdatedAt(new \DateTime())
            ->setGithubPushedAt(new \DateTime());

        return $repo;
    }
}
