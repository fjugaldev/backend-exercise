<?php

namespace App\Framework\Controller;


use App\Domain\Service\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecipeController
 *
 * Handles all the recipes request.
 *
 * @Route("/api/v1")
 */
class RecipeController extends Controller
{
    /**
     * Searchs for a recipes list based on a query parameters.
     *
     * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $parameters = [];

        // Ingredients parameter
        if ($request->request->has('ingredients')) {
            $parameters['ingredients'] = $request->request->get('ingredients');
        }

        // Query parameter
        if ($request->request->has('query')) {
            $parameters['query'] = $request->request->get('query');
        }

        // Page parameter
        if ($request->request->has('page')) {
            $parameters['page'] = $request->request->get('page');
        }

        $this->get(RecipeService::class)->searchBy($parameters);
    }

    /**
     * Get a recipes list.
     *
     * @param Request $request
     */
    public function getRecipeList(Request $request)
    {
    }
}