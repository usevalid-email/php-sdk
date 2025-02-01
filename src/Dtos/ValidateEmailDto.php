<?php

namespace UseValidEmail\Sdk\Dtos;

class ValidateEmailDto
{
    public string $email;

    public function __construct(
        string $email

    ) {
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
