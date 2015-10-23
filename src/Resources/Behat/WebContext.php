<?php
namespace Resources\Behat;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Behat context class.
 */
class WebContext extends MinkContext implements SnippetAcceptingContext
{
    private $output;
    use ScreenshotTrait;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Then I should see :text in the output
     *
     * @param $text
     *
     * @throws \Exception
     */
    public function iShouldSeeInTheOutput($text)
    {
        if (strpos($this->output, $text) === false) {
            throw new \Exception('Could not find text '.$text);
        }
    }

    /**
     * @When I click :text
     *
     * @param $text
     */
    public function iClick($text)
    {
        $this->clickLink($text);
    }

    /**
     * @Then /^I should see "([^"]+)" on page headline$/
     *
     * @param $text
     *
     * @throws \Exception
     */
    public function iShouldSeeTextOnPageHeadline($text)
    {
        $result = $this->getSession()->getPage()->find('xpath', '//h1[contains(., "'.$text.'")]');

        if (null === $result) {
            $msg = "Text '$text' was not found on page headline";
            throw new \Exception($msg);
        };
    }

    /**
     * Checks, that URL is equal to specified.
     *
     * @Then /^url is "(?P<url>[^"]+)"$/
     *
     * @param $url
     *
     * @throws \Exception
     */
    public function assertUrl($url)
    {
        $expectedUrl = $this->locatePath($url);

        $actualUrl = $this->getSession()->getCurrentUrl();

        if ($expectedUrl !== $actualUrl) {
            $msg = sprintf('Current url is "%s", but "%s" expected.', $actualUrl, $expectedUrl);
            throw new \Exception($msg);
        }
    }

    /**
     * Attaches file to field with specified xpath.
     *
     * @When /^(?:|I )attach the file "(?P<path>[^"]*)" using xpath to "(?P<field>(?:[^"]|\\")*)"$/
     *
     * @param $field
     * @param $path
     */
    public function iAttachTheFileUsingXpathToInputType($field, $path)
    {
        $session  = $this->getSession();
        $selector = $session->getSelectorsHandler()->selectorToXpath('xpath', $field);
        $element  = $session->getPage()->find('xpath', $selector);

        $this->attachFileToField($element->getAttribute('id'), $path);
    }
}
