<?php

declare(strict_types=1);

namespace App\RRSS\Domain;

use App\RRSS\Domain\ValueObject\UserEmail;
use App\RRSS\Domain\ValueObject\UserName;
use App\RRSS\Domain\ValueObject\UserProfilePicture;
use App\RRSS\Domain\ValueObject\UserStatus;
use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class User extends AggregateRoot
{
    private const DEFAULT_STATUS = UserStatus::ACTIVE;

    private function __construct(
        private UuidInterface $id,
        private UserName $name,
        private UserEmail $email,
        private UserProfilePicture $profilePicture,
        private UserStatus $status,
    ) {
    }

    public function create(
        string $name,
        string $email,
        string $profilePicture,
    ): self {
        return new self(
            Uuid::uuid7(),
            UserName::fromString($name),
            UserEmail::fromString($email),
            UserProfilePicture::fromString($profilePicture),
            self::DEFAULT_STATUS
        );
    }

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getProfilePicture(): string
    {
        return (string) $this->profilePicture;
    }

    public function getStatus(): string
    {
        return $this->status->value;
    }
}
