<?php
namespace DevBoard\GithubEvent\Status\Data;

use DevBoard\GithubEvent\Payload\StatusPayload;
use DevBoard\GithubRemote\ValueObject\ExternalService\ExternalService;

/**
 * Class ExternalServiceFactory.
 */
class ExternalServiceFactory
{
    /**
     * @param StatusPayload $statusPayload
     *
     * @return ExternalService
     */
    public function create(StatusPayload $statusPayload)
    {
        return new ExternalService(
            $statusPayload->getContext()
        );
    }
}
