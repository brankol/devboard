<?php
namespace DevBoard\Github\WebHook;

/**
 * Class WebHookSignature.
 */
class WebHookSignature
{
    /** @var string */
    private $algorithm;

    /** @var string */
    private $signature;

    /**
     * WebHookSignature constructor.
     *
     * @param string $algorithm
     * @param string $signature
     */
    public function __construct($algorithm, $signature)
    {
        $this->algorithm = $algorithm;
        $this->signature = $signature;
    }

    /**
     * @return string
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}
