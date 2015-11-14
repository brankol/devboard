<?php
namespace DevBoard\Github\WebHook;

/**
 * Class WebHookSignatureFactory.
 */
class WebHookSignatureFactory
{
    /**
     * @param $githubHeaderSignature
     *
     * @return WebHookSignature
     */
    public function create($githubHeaderSignature)
    {
        list($algorithm, $signature) = explode('=', $githubHeaderSignature);

        return new WebHookSignature($algorithm, $signature);
    }
}
