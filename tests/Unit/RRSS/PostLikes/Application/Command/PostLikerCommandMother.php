<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\PostLikes\Application\Command;

use App\RRSS\PostLikes\Application\Command\PostLikerCommand;
use Ramsey\Uuid\Uuid;

final class PostLikerCommandMother
{
    public static function create(string $id, string $postId, string $userId): PostLikerCommand
    {
        return new PostLikerCommand($id, $postId, $userId);
    }

    public static function random(): PostLikerCommand
    {
        return self::create(
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
        );
    }
}
