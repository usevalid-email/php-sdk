<?php

namespace UseValidEmail\Sdk;

use GuzzleHttp\Exception\GuzzleException;
use UseValidEmail\Sdk\Dtos\ValidateEmailDto;
use UseValidEmail\Sdk\Exceptions\ForbiddenException;
use UseValidEmail\Sdk\Exceptions\UnauthorizedException;
use UseValidEmail\Sdk\Requests\HttpClient;
use UseValidEmail\Sdk\Responses\Validation\ValidationResponse;

/**
 * Class EmailValidator
 */
class EmailValidator
{
    protected bool $logs;

    protected HttpClient $api;

    public function __construct(HttpClient $api, bool $logs = false)
    {
        $this->api = $api;
        $this->logs = $logs;
    }

    /**
     * Create a Charge
     *
     * @throws GuzzleException
     * @throws UnauthorizedException
     * @throws ForbiddenException
     */
    public function validate(string $email): ValidationResponse
    {
        $data = new ValidateEmailDto($email);
        $response = $this->api->post('EmailValidator@validate', '/verify/v1', $data->toArray(), $this->logs);

        if ($response->getStatusCode() === 401) {
            throw new UnauthorizedException;
        }

        if ($response->getStatusCode() === 403) {
            throw new ForbiddenException;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        return ValidationResponse::fromArray($data);
    }
}
