<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Application\Command;

use App\RRSS\Users\Application\Command\CreateUserCommand;
use Ramsey\Uuid\Uuid;

final class CreateUserCommandMother
{
    public static function create(
        string $id,
        string $name,
        string $email,
        string $profilePicture
    ): CreateUserCommand {
        return new CreateUserCommand(
            $id,
            $name,
            $email,
            $profilePicture
        );
    }

    public static function random(): CreateUserCommand
    {
        return self::create(
            Uuid::uuid7()->toString(),
            'name'.rand(1, 1000),
            'email'.rand(1, 1000).'@mail.com',
            'profile_picture'.rand(1, 1000).'.png'
        );
    }
}
