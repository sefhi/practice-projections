<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\CreateRetentionUserCommand;
use Ramsey\Uuid\Uuid;

final class CreateRetentionUserCommandMother
{
    public static function create(
        string $id,
        string $name,
        string $email
    ): CreateRetentionUserCommand {
        return new CreateRetentionUserCommand(
            $id,
            $name,
            $email,
        );
    }

    public static function random(): CreateRetentionUserCommand
    {
        return self::create(
            Uuid::uuid7()->toString(),
            'name',
            'email',
        );
    }
}
