<?php

namespace App\Framework\Controller;


use App\Domain\Service\RecipeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecipeController
 *
 * Handles all the recipes request.
 *
 * @Route("/api/v1/recipe")
 */
class RecipeController extends Controller
{
    /**
     * Search for a recipes list based on a query parameters.
     * @Route(path="/search", methods={"GET","HEAD"}, name="recipe_search")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchAction(Request $request): JsonResponse
    {
        $parameters = [];

        // Query parameter validator
        if ($request->query->has('query')) {
            $parameters['q'] = $request->query->get('query');
        }

        // Ingredients parameter validator
        if ($request->query->has('ingredients')) {
            $parameters['i'] = $request->query->get('ingredients');
        }

        // Page parameter validator
        if ($request->query->has('page')) {
            $parameters['p'] = $request->query->get('page');
        }

        // Search recipes by query parameters.
        $response = $this->get('api.service.recipe_service')->searchBy($parameters);

        // Returns a JsonResponse.
        return new JsonResponse($response, $response['status']);
    }

    /**
     * Get a recipes list.
     * @Route(path="/list", methods={"GET","HEAD"},  name="recipe_list")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getRecipeListAction(Request $request): JsonResponse
    {
        $parameters = [];

        // Page parameter validator
        if ($request->query->has('page')) {
            $parameters['p'] = $request->query->get('page');
        }

        // Get recipes list by query parameters.
        $response = $this->get('api.service.recipe_service')->getList($parameters);

        // Returns a JsonResponse.
        return new JsonResponse($response, $response['status']);
    }
}
