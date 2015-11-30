<?php
namespace spec\DevBoard\GithubEvent\Payload;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatusPayloadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubEvent\Payload\StatusPayload');
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
}
