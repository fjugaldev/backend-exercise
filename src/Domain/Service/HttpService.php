<?php

namespace App\Domain\Service;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class HttpService
 * Handles http request vía GuzzleHttp Client.
 */
class HttpService
{
    // CONSTANTS
    // HTTP Methods.
    const METHOD_GET     = 'GET';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_OPTIONS = 'OPTIONS';
    // HTTP STATUS CODE RESPONSES
    const STATUS_200     = 200;
    const STATUS_201     = 201;
    const STATUS_301     = 301;
    const STATUS_401     = 401;
    const STATUS_403     = 403;
    const STATUS_404     = 404;
    const STATUS_500     = 500;
    const STATUS_503     = 503;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * HttpService constructor.
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->setClient($httpClient);
    }


    /**
     * Makes the Http request using guzzle.
     * @param string $method
     * @param array  $options
     *
     * @return ResponseInterface;
     *
     * @throws \Exception
     */
    public function request(string $method = 'GET', array $options = []): ResponseInterface
    {
        try {
            // Sends the request via GuzzleHttp.
            return $this->getClient()->request($method, '', $options);

        } catch (GuzzleException $e) {
            // Throws an Exception.
            throw new \Exception(json_encode(["code" => $e->getCode(), "message" => $e->getMessage()]));
        }
    }

    /**
     * Gets the GuzzleHttp Client
     * @return Client
     */
    private function getClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * Sets de GuzzleHttp Client
     * @param Client $httpClient
     *
     * @return HttpService
     */
    private function setClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
