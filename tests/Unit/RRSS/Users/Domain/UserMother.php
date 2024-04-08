<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain;

use App\RRSS\Users\Application\Command\CreateUserCommand;
use App\RRSS\Users\Domain\User;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserEmailMother;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserNameMother;
use App\Tests\Unit\RRSS\Users\Domain\ValueObject\UserProfilePictureMother;
use Ramsey\Uuid\Uuid;

final class UserMother
{
    public static function create(
        string $id,
        string $name,
        string $email,
        string $profilePicture
    ): User {
        return User::create(
            $id,
            $name,
            $email,
            $profilePicture
        );
    }

    public static function random(): User
    {
        return self::create(
            Uuid::uuid7()->toString(),
            UserNameMother::random()->value(),
            UserEmailMother::random()->value(),
            UserProfilePictureMother::random()->value()
        );
    }

    public static function fromCommand(CreateUserCommand $command): User
    {
        return self::create(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->profilePicture()
        );
    }
}
