<?php
namespace spec\DevBoard\GithubApi\Repository\Hook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HookSettingsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\GithubApi\Repository\Hook\HookSettings');
    }

    public function let()
    {
        $this->beConstructedWith('web', $this->defaultConfigParams(), $this->defaultEventsParams());
    }

    public function it_will_return_name_of_the_hook()
    {
        $this->getName()->shouldReturn('web');
    }

    public function it_will_return_api_endpoint_url()
    {
        $this->getUrl()->shouldReturn('http://example.com/notification');
    }

    public function it_will_not_accept_anything_but_web_as_name_of_the_hook()
    {
        $this->shouldThrow('Exception')->during__construct('webhook-name', [], []);
    }

    public function it_will_return_config_params_as_array()
    {
        $this->getConfigParams()->shouldReturn($this->defaultConfigParams());
    }

    public function it_will_return_event_params_as_array()
    {
        $this->getEventParams()->shouldReturn($this->defaultEventsParams());
    }

    public function it_will_return_hook_as_array()
    {
        $data = [
            'name'   => 'web',
            'config' => $this->defaultConfigParams(),
            'events' => $this->defaultEventsParams(),
        ];

        $this->getAllParams()->shouldReturn($data);
    }

    public function it_will_return_array_to_create_an_active_hook()
    {
        $data = [
            'name'   => 'web',
            'config' => $this->defaultConfigParams(),
            'events' => $this->defaultEventsParams(),
            'active' => true,
        ];

        $this->getCreateHookParams()->shouldReturn($data);
    }

    public function it_will_return_array_to_deactivate_an_active_hook()
    {
        $data = [
            'name'   => 'web',
            'config' => $this->defaultConfigParams(),
            'events' => $this->defaultEventsParams(),
            'active' => false,
        ];

        $this->getDeactivateHookParams()->shouldReturn($data);
    }

    protected function defaultConfigParams()
    {
        return [
            'url'          => 'http://example.com/notification',
            'content_type' => 'json',
            'insecure_ssl' => 0,
            'secret'       => 'secret',
        ];
    }

    protected function defaultEventsParams()
    {
        return ['push', 'pull_request', 'status'];
    }
}
