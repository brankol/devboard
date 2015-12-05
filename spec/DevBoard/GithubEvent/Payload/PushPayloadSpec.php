<?php
namespace spec\DevBoard\GithubEvent\Payload;

use DevBoard\GithubEvent\Payload\PushPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PushPayloadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Payload\PushPayload');
    }

    public function let()
    {
        $data = [
            'ref'         => 'refs/heads/new-branch',
            'head_commit' => [
                'author'    => ['name' => 'name', 'email' => 'email@example.com', 'username' => 'username'],
                'committer' => ['name' => 'name2', 'email' => 'email2@example.com', 'username' => 'username2'],
            ],
            'repository' => ['id' => 1, 'name' => 'name', 'owner' => ['name' => 'owner']],
        ];

        $this->beConstructedWith($data);
    }

    public function it_knows_if_event_is_related_to_branch()
    {
        $this->beConstructedWith(['ref' => 'refs/heads/new-branch']);
        $this->isBranch()->shouldReturn(true);
        $this->isTag()->shouldReturn(false);
    }

    public function it_knows_if_event_is_related_to_tag()
    {
        $this->beConstructedWith(['ref' => 'refs/tags/new-tag']);
        $this->isTag()->shouldReturn(true);
        $this->isBranch()->shouldReturn(false);
    }

    public function it_knows_branch_name()
    {
        $this->beConstructedWith(['ref' => 'refs/heads/new-branch']);

        $this->getBranchName()->shouldReturn('new-branch');
    }

    public function it_knows_tag_name()
    {
        $this->beConstructedWith(['ref' => 'refs/tags/new-tag']);
        $this->getTagName()->shouldReturn('new-tag');
    }

    public function it_throws_exception_on_fetching_branch_name_if_not_branch_reference()
    {
        $this->beConstructedWith(['ref' => 'something']);
        $this->shouldThrow('Exception')->duringGetBranchName();
    }

    public function it_throws_exception_on_fetching_tag_name_if_not_tag_reference()
    {
        $this->beConstructedWith(['ref' => 'something']);
        $this->shouldThrow('Exception')->duringGetTagName();
    }

    public function it_returns_create_type_of_event()
    {
        $this->beConstructedWith(['created' => true, 'deleted' => false]);
        $this->isCreate()->shouldReturn(true);
        $this->getType()->shouldReturn(PushPayload::CREATED);
    }

    public function it_returns_update_type_of_event()
    {
        $this->beConstructedWith(['created' => false, 'deleted' => false]);
        $this->isUpdate()->shouldReturn(true);
        $this->getType()->shouldReturn(PushPayload::UPDATED);
    }

    public function it_returns_delete_type_of_event()
    {
        $this->beConstructedWith(['created' => false, 'deleted' => true]);
        $this->isDelete()->shouldReturn(true);
        $this->getType()->shouldReturn(PushPayload::DELETED);
    }

    public function it_returns_repo_data()
    {
        $data = ['id' => 1, 'name' => 'name', 'owner' => ['name' => 'owner']];

        $this->getRepositoryDetails()->shouldReturn($data);
    }

    public function it_returns_head_commit_data()
    {
        $data = [
            'author'    => ['name' => 'name', 'email' => 'email@example.com', 'username' => 'username'],
            'committer' => ['name' => 'name2', 'email' => 'email2@example.com', 'username' => 'username2'],
        ];

        $this->getHeadCommitDetails()->shouldReturn($data);
    }

    public function it_returns_head_commit_author_data()
    {
        $this->getCommitAuthorDetails()
            ->shouldReturn(['name' => 'name', 'email' => 'email@example.com', 'username' => 'username']);
    }

    public function it_returns_head_commit_committer_data()
    {
        $this->getCommitCommiterDetails()
            ->shouldReturn(['name' => 'name2', 'email' => 'email2@example.com', 'username' => 'username2']);
    }
}
