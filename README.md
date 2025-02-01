# usevalid.email

[![PHP Composer](https://github.com/usevalid-email/php-sdk/actions/workflows/php.yml/badge.svg)](https://github.com/usevalid-email/php-sdk/actions/workflows/php.yml)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/usevalid-email/sdk.svg?style=flat-square)](https://packagist.org/packages/usevalid-email/sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/usevalid-email/sdk.svg?style=flat-square)](https://packagist.org/packages/usevalid-email/sdk)
[![License](https://img.shields.io/packagist/l/usevalid-email/sdk.svg?style=flat-square)](https://packagist.org/packages/usevalid-email/sdk)

Validate Your Emails with Confidence

## Installation

You can install the package via composer:

```bash
composer require usevalid-email/php-sdk
```

## Usage

### Initialization

```php
use UseValidEmail\Sdk;

$token = 'your-access-token';
$sdk = new Sdk($token);
```
### Validate Email
    
```php
use UseValidEmail\Sdk\Exceptions\AccessTokenException;
use UseValidEmail\Sdk\Exceptions\ForbiddenException;
use UseValidEmail\Sdk\Exceptions\UnauthorizedException;
use GuzzleHttp\Exception\GuzzleException;

try {
    $email = 'example@example.com';
    $response = $sdk->emailValidator->validate($email);
    print_r($response->toArray());
} catch (Exception $e) {
    // Handle exception
}
```

### Using Helper Function

```php
use GuzzleHttp\Exception\GuzzleException;
use UseValidEmail\Sdk\Exceptions\AccessTokenException;
use UseValidEmail\Sdk\Exceptions\ForbiddenException;
use UseValidEmail\Sdk\Exceptions\UnauthorizedException;
use UseValidEmail\Sdk\Responses\Validation\ValidationResponse;

try {
    $email = 'example@example.com';
    $response = validateEmail($email);
    print_r($response->toArray());
} catch (Exception $e) {
    // Handle exception
}
```
## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [All Contributors](https://github.com/usevalid-email/php-sdk/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
