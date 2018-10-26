<?php

namespace App\Domain\Service;


use GuzzleHttp\Client;

/**
 * Class HttpService
 */
class HttpService
{
    const API_BASE_URI = "http://www.recipepuppy.com/api/";

    protected $httpClient;

    /**
     * HttpService constructor.
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function request()
    {}
}