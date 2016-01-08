<?php
namespace DevBoard\GithubApi\Repository\Hook;

/**
 * Class HookSettings.
 */
class HookSettings
{
    private $name;

    private $configParams;

    private $eventParams;

    /**
     * HookSettings constructor.
     *
     * @param       $name
     * @param array $configParams
     * @param array $eventParams
     *
     * @throws \Exception
     */
    public function __construct($name, array $configParams, array $eventParams)
    {
        if ('web' !== $name) {
            throw new \Exception('Hooks must be named "web".');
        }

        $this->name         = $name;
        $this->configParams = $configParams;
        $this->eventParams  = $eventParams;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->configParams['url'];
    }

    /**
     * @return array
     */
    public function getConfigParams()
    {
        return $this->configParams;
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return $this->eventParams;
    }

    /**
     * @return array
     */
    public function getAllParams()
    {
        return [
            'name'   => $this->getName(),
            'config' => $this->getConfigParams(),
            'events' => $this->getEventParams(),
        ];
    }

    /**
     * @return array
     */
    public function getCreateHookParams()
    {
        return array_merge($this->getAllParams(), ['active' => true]);
    }

    /**
     * @return array
     */
    public function getDeactivateHookParams()
    {
        return array_merge($this->getAllParams(), ['active' => false]);
    }
}
