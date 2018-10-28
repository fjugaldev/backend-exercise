<?php

namespace App\Tests;


use App\Domain\Service\RecipeService;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RecipeServiceTest
 */
class RecipeServiceTest extends WebTestCase
{

    /** @var ContainerInterface $container */
    protected $container;

    /**
     * Test for the RecipeService Class
     */
    public function testSearchBy()
    {
        $parameters = [
            'q' => 'omelet',
            'i' => 'onions,garlic',
            'p' => 1,
        ];

        // Gets the container.
        static::bootKernel();
        $this->container = static::$kernel->getContainer();

        // Instances the RecipeService class.
        $recipeService = new RecipeService($this->container);
        $result = $recipeService->searchBy($parameters);

        // Asserts for the PHPUnit tests.
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals(200, $result['status']);
        $this->assertArrayHasKey('data', $result);
        $this->assertGreaterThan(0, count($result['data']));
        $this->assertArrayHasKey('title', $result['data'][0]);
        $this->assertArrayHasKey('href', $result['data'][0]);
        $this->assertArrayHasKey('ingredients', $result['data'][0]);
        $this->assertArrayHasKey('thumbnail', $result['data'][0]);
    }
}