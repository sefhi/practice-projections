<?php

declare(strict_types=1);

namespace App\Retention\Users\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class RetentionUser extends AggregateRoot
{
    private function __construct(
        private UuidInterface $id,
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
            Uuid::fromString($id),
            $name,
            $email,
        );
    }

    public function getId(): string
    {
        return $this->id->toString();
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
