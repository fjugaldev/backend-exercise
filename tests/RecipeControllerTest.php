<?php

namespace App\Tests;


use App\Domain\Service\HttpService;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RecipeControllerTest
 */
class RecipeControllerTest extends WebTestCase
{
    /** @var Client $client */
    protected $client;

    /**
     * Test for the RecipeController class.
     */
    public function testSearchAction()
    {
        $this->client = static::createClient();
        $parameters = [
            'q' => 'omelet',
            'i' => 'onions,garlic',
            'p' => 1,
        ];

        $this->client->request(
            HttpService::METHOD_GET,
            '/api/v1/recipe/search',
            $parameters
        );

        $statusCode = $this->client->getResponse()->getStatusCode();
        $content = json_decode($this->client->getResponse()->getContent(), true);

        // Asserts for the PHPUnit tests.
        $this->assertArrayHasKey('status', $content);
        $this->assertEquals(200, $statusCode);
        $this->assertArrayHasKey('data', $content);
        $this->assertGreaterThan(0, count($content['data']));
        $this->assertArrayHasKey('title', $content['data'][0]);
        $this->assertArrayHasKey('href', $content['data'][0]);
        $this->assertArrayHasKey('ingredients', $content['data'][0]);
        $this->assertArrayHasKey('thumbnail', $content['data'][0]);
    }
}