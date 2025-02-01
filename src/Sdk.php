<?php

namespace UseValidEmail\Sdk;

use UseValidEmail\Sdk\Exceptions\AccessTokenException;
use UseValidEmail\Sdk\Requests\HttpClient;

class Sdk
{
    public const DEFAULT_BASE_URI = 'https://usevalid-email.p.rapidapi.com';

    protected bool $logs;

    protected HttpClient $api;

    public EmailValidator $emailValidator;

    /**
     * @throws AccessTokenException
     */
    public function __construct(
        ?string $accessToken = null,
        ?bool $logs = false,
        ?string $baseUri = self::DEFAULT_BASE_URI
    ) {
        $this->logs = $logs;
        if (! $accessToken) {
            throw new AccessTokenException;
        }
        $options = [
            'base_uri' => $baseUri,
            'headers' => [
                'X-RapidAPI-Key' => $accessToken,
                'X-RapidAPI-Host' => str_replace('https://', '', $baseUri),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ];

        $this->api = HttpClient::make('UseValidEmailSdk', $options, $this->logs);

        $this->emailValidator = new EmailValidator($this->api);
    }

    /**
     * @throws AccessTokenException
     */
    public static function make(?string $accessToken = null,
        ?string $baseUri = null): Sdk
    {
        return new Sdk($accessToken, $baseUri);
    }

    public static function getAccessToken(): ?string
    {
        return getenv('USE_VALID_EMAIL_ACCESS_TOKEN') ?: null;
    }
}
