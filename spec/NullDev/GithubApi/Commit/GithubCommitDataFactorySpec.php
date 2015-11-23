<?php
namespace spec\NullDev\GithubApi\Commit;

use DevBoard\Github\Repo\Entity\GithubRepo;
use NullDev\GithubApi\User\GithubUserData;
use NullDev\GithubApi\User\GithubUserDataFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubCommitDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\GithubApi\Commit\GithubCommitDataFactory');
    }

    public function let(GithubUserDataFactory $githubUserDataFactory)
    {
        $this->beConstructedWith($githubUserDataFactory);
    }

    public function it_will_create_new_instance_using_array_from_github(
        $githubUserDataFactory,
        GithubRepo $githubRepo,
        GithubUserData $author,
        GithubUserData $committer
    ) {
        $authorData = [
            'name'  => 'username',
            'email' => 'username@example.com',
            'date'  => '2015-11-14T21:46:01+01:00',
        ];
        $committerData = [
            'name'  => 'username2',
            'email' => 'username2@example.com',
            'date'  => '2015-11-14T21:46:01+01:00',
        ];

        $arr = [
            'id'             => '7926af05b7f1bb4b1ed440aa5693fa9f36644640',
            'distinct'       => true,
            'message'        => 'wip',
            'author_date'    => '2015-11-14T21:46:01+01:00',
            'committer_date' => '2015-11-14T21:46:01+01:00',
            'url'            => 'https://github.com/devboard/devboard/commit/7926af05b7f1bb4b1ed440aa5693fa9f36644640',
            'commit'         => [
                'author'    => ['date' => '2015-11-14T21:46:01+01:00'],
                'committer' => ['date' => '2015-11-14T21:46:01+01:00'],
            ],
            'author'    => $authorData,
            'committer' => $committerData,
        ];

        $githubUserDataFactory->create($authorData)->willReturn($author);
        $githubUserDataFactory->create($committerData)->willReturn($committer);

        $result = $this->create($githubRepo, $arr);

        $result->shouldBeAnInstanceOf('NullDev\GithubApi\Commit\GithubCommitData');
    }
}
