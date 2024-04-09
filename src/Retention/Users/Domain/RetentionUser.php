<?php

declare(strict_types=1);

namespace App\Retention\Users\Domain;

final class RetentionUser
{
    private function __construct(
        private string $id,
        private string $name,
        private string $email,
    ) {
    }

    public static function create(
        string $id,
        string $name,
        string $email
    ): self {
        return new self(
            $id,
            $name,
            $email,
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
