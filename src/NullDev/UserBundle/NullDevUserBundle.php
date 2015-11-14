<?php
namespace NullDev\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class NullDevUserBundle.
 */
class NullDevUserBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
