<?php

namespace App\Domain\Service;

use App\Domain\Model\Recipe;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RecipeService
 */
class RecipeService
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * RecipeService constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }


    /**
     * Search recipes based on a query params.
     * @param array $parameters
     *
     * @return array
     */
    public function searchBy(array $parameters): array
    {
        try {
            // Send http request to the API (www.recipepuppy.com).
            /** @var ResponseInterface $responseInterface */
            $responseInterface = $this->getHttp()->request(HttpService::METHOD_GET, [
                'query' => $parameters,
            ]);

            // Unwrap the request body contents.
            $apiResponse = json_decode($responseInterface->getBody()->getContents());

            // Iterates the results in order to parse items into a recipe object and push it into the data array.
            $data = [];
            foreach ($apiResponse->results as $item) {
                // Instances a new recipe object with the item data.
                $recipe = new Recipe();
                $recipe->setTitle($item->title);
                $recipe->setIngredients($item->ingredients);
                $recipe->setHref($item->href);
                $recipe->setThumbnail($item->thumbnail);

                // Push the recipe object into the data array.
                array_push($data, $recipe->__toJson());
            }

            // Response content.
            $response = [
                'status' => HttpService::STATUS_200,
                'data'   => $data,
            ];

        } catch (\Exception $e) {
            // Error content
            $response = [
                'status' => HttpService::STATUS_500,
                'error'  => $e->getMessage(),
            ];
        }

        // Returns the response content.
        return $response;
    }

    /**
     * Gets recipes list.
     * @param array $parameters
     *
     * @return array
     */
    public function getList(array $parameters): array
    {
        try {
            // Send http request to the API (www.recipepuppy.com).
            /** @var ResponseInterface $responseInterface */
            $responseInterface = $this->getHttp()->request(HttpService::METHOD_GET, [
                'query' => $parameters,
            ]);

            // Unwrap the request body contents.
            $apiResponse = json_decode($responseInterface->getBody()->getContents());

            // Iterates the results in order to parse items into a recipe object and push it into the data array.
            $data = [];
            foreach ($apiResponse->results as $item) {
                // Instances a new recipe object with the item data.
                $recipe = new Recipe();
                $recipe->setTitle($item->title);
                $recipe->setIngredients($item->ingredients);
                $recipe->setHref($item->href);
                $recipe->setThumbnail($item->thumbnail);

                // Push the recipe object into the data array.
                array_push($data, $recipe->__toJson());
            }

            // Response content.
            $response = [
                'status' => HttpService::STATUS_200,
                'data'   => $data,
            ];

        } catch (\Exception $e) {
            // Error content
            $response = [
                'status' => HttpService::STATUS_500,
                'error'  => $e->getMessage(),
            ];
        }

        // Returns the response content.
        return $response;
    }

    /**
     * Gets the Service Container.
     * @return ContainerInterface
     */
    private function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * Sets de Service Container.
     * @param ContainerInterface $container
     *
     * @return RecipeService
     */
    private function setContainer(ContainerInterface $container): self
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Gets the HttpService class.
     *
     * @return HttpService
     */
    private function getHttp(): HttpService
    {
        return $this->getContainer()->get('api.service.http_service');
    }
}
