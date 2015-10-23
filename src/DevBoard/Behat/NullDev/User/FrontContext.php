<?php
namespace DevBoard\Behat\NullDev\User;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use DevBoard\Github\User\User;
use Resources\Behat\DomainContext;
use Resources\Behat\WebContext;

/**
 * Behat context class.
 */
class FrontContext extends WebContext implements SnippetAcceptingContext
{
    use DataTrait;
}
