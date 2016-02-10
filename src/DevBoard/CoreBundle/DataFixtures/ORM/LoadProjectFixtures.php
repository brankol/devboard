<?php
namespace DevBoard\CoreBundle\DataFixtures\ORM;

use DevBoard\Core\Project\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadProjectFixtures.
 */
class LoadProjectFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = [
            $this->getReference('user-visitor1'),
            $this->getReference('user-msvrtan'),
            $this->getReference('user-brankol'),
        ];

        $publicRepos = [
            $this->getReference('gh-repo-devboard/test-assassin'),
            $this->getReference('gh-repo-devboard/test-hitman'),
            $this->getReference('gh-repo-devboard/test-mermaid'),
        ];

        foreach ($publicRepos as $repo) {
            foreach ($users as $user) {
                $project = new Project();
                $project->setProjectName($repo->getFullName())
                    ->addGithubRepo($repo)
                    ->setUser($user);

                $manager->persist($project);
            }
        }
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 90;
    }
}
