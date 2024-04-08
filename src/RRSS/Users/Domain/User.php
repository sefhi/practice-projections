<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain;

use App\RRSS\Users\Domain\ValueObject\UserEmail;
use App\RRSS\Users\Domain\ValueObject\UserName;
use App\RRSS\Users\Domain\ValueObject\UserProfilePicture;
use App\RRSS\Users\Domain\ValueObject\UserStatus;
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

    public static function create(
        string $id,
        string $name,
        string $email,
        string $profilePicture,
    ): self {
        $user = new self(
            Uuid::fromString($id),
            UserName::fromString($name),
            UserEmail::fromString($email),
            UserProfilePicture::fromString($profilePicture),
            self::DEFAULT_STATUS
        );

        $user->record(
            new UserRegisteredDomainEvent(
                $user->id->toString(),
                $user->name->value(),
                $user->email->value(),
                $user->profilePicture->value(),
                self::DEFAULT_STATUS->value,
            )
        );

        return $user;
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
