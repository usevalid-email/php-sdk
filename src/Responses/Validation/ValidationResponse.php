<?php

namespace UseValidEmail\Sdk\Responses\Validation;

class ValidationResponse
{
    public string $reason;

    public string $domain;

    public ?string $user;

    public string $email;

    public bool $disposable;

    public string $status;

    public function __construct(
        string $reason,
        string $domain,
        ?string $user,
        string $email,
        bool $disposable,
        string $status

    ) {
        $this->reason = $reason;
        $this->domain = $domain;
        $this->user = $user;
        $this->email = $email;
        $this->disposable = $disposable;
        $this->status = $status;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['reason'],
            $data['domain'],
            $data['user'],
            $data['email'],
            $data['disposable'],
            $data['status']
        );
    }

    public function toArray(): array
    {
        return [
            'reason' => $this->reason,
            'domain' => $this->domain,
            'user' => $this->user,
            'email' => $this->email,
            'disposable' => $this->disposable,
            'status' => $this->status,
        ];
    }
}
