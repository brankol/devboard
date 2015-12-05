<?php
namespace DevBoard\Behat\Github\Tag;

use DevBoard\Github\Tag\Entity\GithubTag;

/**
 * Class DataTrait.
 */
trait DataTrait
{
    /**
     * @param $repo
     * @param $name
     *
     * @throws \Exception
     *
     * @return
     */
    private function getGithubTagByName($repo, $name)
    {
        $tag = $this->getGithubTagRepository()
            ->findOneByName(
                $repo,
                $name
            );

        if (!$tag) {
            throw new \Exception('Cant find github tag with name:'.$name);
        }

        return $tag;
    }

    /**
     * @return mixed
     */
    private function getGithubTagRepository()
    {
        return $this->getEntityManager()->getRepository('GhTag:GithubTag');
    }

    /**
     * @param $name
     *
     * @return GithubTag
     */
    private function createTagObjectFromTagName($name)
    {
        $tag = new GithubTag();
        $tag->setName($name);

        return $tag;
    }
}
