<?php

namespace App\Domain\Service;


class RecipeService
{

    protected $http;

    /**
     * RecipeService constructor.
     */
    public function __construct(HttpService $http)
    {
        $this->http = $http;
    }

    public function searchBy(array $parameters): array
    {}

    public function getList(): array
    {}
}