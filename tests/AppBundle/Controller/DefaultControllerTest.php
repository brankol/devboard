<?php
namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest.
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertTrue($crawler->filter('html:contains("Have all relevant github projects info in one place")')->count() > 0);
    }
}
