<?php

namespace UseValidEmail\Sdk\Requests;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use PhpHttpClient\Client as PhpHttpClient;
use UseValidEmail\Sdk\Utils\Log;

class HttpClient
{
    private string $packageName;

    private PhpHttpClient $httpClient;

    public array $defaultOptions;

    public function __construct(string $packageName, array $options = [])
    {
        $this->packageName = $packageName;
        $baseUri = $options['base_uri'];
        $this->httpClient = new PhpHttpClient($baseUri, $options);
        $this->defaultOptions = $options;
    }

    public static function make(string $packageName, array $options = []): HttpClient
    {
        return new HttpClient($packageName, $options);
    }

    /**
     * @throws GuzzleException
     */
    public function get(
        string $requestName,
        string $requestUri,
        array $options = [],
        bool $logger = true
    ): \Psr\Http\Message\ResponseInterface {
        $options = array_merge($this->defaultOptions, $options);
        $response = $this->httpClient->get($requestUri, $options);
        if ($logger) {
            $this->logger($requestName, $requestUri, $options, $response->getBody()->getContents());
        }

        return $response;
    }

    /**
     * @throws GuzzleException
     */
    public function post(
        string $requestName,
        string $requestUri,
        array $options = [],
        bool $logger = true
    ): \Psr\Http\Message\ResponseInterface {
        $options = array_merge($this->defaultOptions, $options);
        $response = $this->httpClient->post($requestUri, $options);
        if ($logger) {
            $this->logger($requestName, $requestUri, $options, $response->getBody()->getContents());
        }

        return $response;
    }

    private function logger(string $requestName, string $requestUri, array $requestPayload = [], ?string $responseBody = null): void
    {
        try {
            Log::make(true)->info("Requests.{$this->packageName}.{$requestName}", [
                'uri' => $requestUri,
                'payload' => $requestPayload,
                'response' => $responseBody,
            ]);
        } catch (Exception $exception) {
            Log::make(true)->error($exception->getMessage());
        }
    }
}
