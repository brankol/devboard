<?php
namespace DevBoard\Github\Tag\Entity;

use DevBoard\Github\Repo\Entity\GithubRepo;
use DevBoard\Github\Tag\Mapper\RemoteToEntityMapper;
use DevBoard\GithubRemote\ValueObject\Tag\Tag;

/**
 * Class GithubTagFactory.
 */
class GithubTagFactory
{
    private $mapper;

    /**
     * GithubTagFactory constructor.
     *
     * @param $mapper
     */
    public function __construct(RemoteToEntityMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param GithubRepo $githubRepo
     * @param Tag        $tagValueObject
     *
     * @return GithubTag
     */
    public function createFromValueObject(GithubRepo $githubRepo, Tag $tagValueObject)
    {
        $githubTag = new GithubTag();
        $githubTag->setRepo($githubRepo);

        $this->mapper->map($tagValueObject, $githubTag);

        return $githubTag;
    }
}
