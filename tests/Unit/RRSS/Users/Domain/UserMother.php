<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain;

use App\RRSS\Users\Domain\User;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserEmailMother;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserNameMother;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserProfilePictureMother;

final class UserMother
{
    public static function create(
        string $name,
        string $email,
        string $profilePicture
    ): User {
        return User::create(
            $name,
            $email,
            $profilePicture
        );
    }

    public static function random(): User
    {
        return self::create(
            UserNameMother::random()->value(),
            UserEmailMother::random()->value(),
            UserProfilePictureMother::random()->value()
        );
    }
}