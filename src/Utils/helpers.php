<?php

use GuzzleHttp\Exception\GuzzleException;
use UseValidEmail\Sdk\Exceptions\AccessTokenException;
use UseValidEmail\Sdk\Exceptions\ForbiddenException;
use UseValidEmail\Sdk\Exceptions\UnauthorizedException;
use UseValidEmail\Sdk\Responses\Validation\ValidationResponse;
use UseValidEmail\Sdk\Sdk;

if (! function_exists('validateEmail')) {
    /**
     * @throws UnauthorizedException
     * @throws AccessTokenException
     * @throws ForbiddenException
     * @throws GuzzleException
     */
    function validateEmail(
        string $email,
        ?string $accessToken = null,
        ?string $baseUri = null
    ): ValidationResponse {
        if (! $accessToken) {
            $accessToken = Sdk::getAccessToken();
        }
        if (! $baseUri) {
            $baseUri = Sdk::DEFAULT_BASE_URI;
        }
        $sdk = Sdk::make($accessToken, $baseUri);

        return $sdk->emailValidator->validate($email);
    }
}
