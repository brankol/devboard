<?php
namespace DevBoard\Behat\GithubEvent\Push;

use Behat\Gherkin\Node\TableNode;
use DevBoard\GithubEvent\Payload\PushPayload;
use Exception;
use Resources\Behat\DomainContext;

/**
 * Class GithubEventPushContext.
 */
class GithubEventPushContext extends DomainContext
{
    private $pushPayload;

    /**
     * @Given I received github push event:
     *
     * @param TableNode $table
     *
     * @throws Exception
     */
    public function iReceivedGithubPushEvent(TableNode $table)
    {
        foreach ($table as $row) {
            if ($row['created'] === 'true') {
                $created = true;
            } elseif ($row['created'] === 'false') {
                $created = false;
            } else {
                throw new Exception('Created isnt readable');
            }
            if ($row['deleted'] === 'true') {
                $deleted = true;
            } elseif ($row['deleted'] === 'false') {
                $deleted = false;
            } else {
                throw new Exception('Deleted isnt readable');
            }

            $data = [
                'ref'         => 'refs/heads/'.$row['branch_name'],
                'head_commit' => [
                    'id'        => $row['commitSha'],
                    'message'   => $row['commitMessage'],
                    'timestamp' => '2015-11-20T22:25:30+01:00',
                    'author'    => [
                        'name'     => $row['authorName'],
                        'email'    => $row['authorEmail'],
                        'username' => $row['authorUsername'],
                    ],
                    'committer' => [
                        'name'     => $row['committerName'],
                        'email'    => $row['committerEmail'],
                        'username' => $row['committerUsername'],

                    ],
                ],
                'repository' => [
                    'id'        => '123',
                    'name'      => $row['repositoryName'],
                    'full_name' => $row['repositoryOwner'].'/'.$row['repositoryName'],
                    'owner'     => [
                        'name' => $row['repositoryOwner'],
                    ],
                    'description'    => 'Description of '.$row['repositoryOwner'].'/'.$row['repositoryName'],
                    'fork'           => false,
                    'default_branch' => $row['branch_name'],
                    'private'        => false,
                    'html_url'       => 'https://github.com/'.$row['repositoryOwner'].'/'.$row['repositoryName'],
                    'ssh_url'        => 'git@github.com:'.$row['repositoryOwner'].'/'.$row['repositoryName'].'.git',
                    'git_url'        => 'git://github.com/'.$row['repositoryOwner'].'/'.$row['repositoryName'].'.git',
                    'created_at'     => 1445097225,
                    'updated_at'     => '2015-10-17T15:53:45Z',
                    'pushed_at'      => 1448054741,
                ],
                'created' => $created,
                'deleted' => $deleted,

            ];

            $this->pushPayload = new PushPayload($data);
        }
    }

    /**
     * @When I process push event
     */
    public function iProcessPushEvent()
    {
        $service = $this->getService('github.event.push.handler');

        $service->process($this->pushPayload);
    }
}
