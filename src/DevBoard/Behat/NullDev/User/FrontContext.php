<?php
namespace DevBoard\Behat\NullDev\User;

use Behat\Behat\Context\SnippetAcceptingContext;
use Resources\Behat\WebContext;

/**
 * Behat context class.
 */
class FrontContext extends WebContext implements SnippetAcceptingContext
{
    use DataTrait;
}
