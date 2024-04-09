<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain;

use App\RRSS\Users\Domain\User;
use App\RRSS\Users\Domain\UserRegisteredDomainEvent;

final class UserRegisteredDomainEventMother
{
    public static function create(
        string $id,
        string $name,
        string $email,
        string $profilePicture
    ): UserRegisteredDomainEvent {
        return new UserRegisteredDomainEvent(
            $id,
            $name,
            $email,
            $profilePicture,
            User::DEFAULT_STATUS->value,
        );
    }

    public static function random(): UserRegisteredDomainEvent
    {
        return self::create(
            UserMother::random()->getId(),
            UserMother::random()->getName(),
            UserMother::random()->getEmail(),
            UserMother::random()->getProfilePicture(),
        );
    }
}
