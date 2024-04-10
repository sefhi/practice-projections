<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Posts\Application\Command;

use App\RRSS\Posts\Application\Command\PublishPostCommand;
use Ramsey\Uuid\Uuid;

final class PublishPostCommandMother
{
    public static function create(
        string $id,
        string $userId,
        string $content,
    ): PublishPostCommand {
        return new PublishPostCommand(
            $id,
            $userId,
            $content,
        );
    }

    public static function random(): PublishPostCommand
    {
        return self::create(
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            'content',
        );
    }
}
