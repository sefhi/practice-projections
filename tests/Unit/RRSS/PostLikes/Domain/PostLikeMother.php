<?php

namespace App\Tests\Unit\RRSS\PostLikes\Domain;

use App\RRSS\PostLikes\Domain\PostLike;
use App\Shared\Domain\ValueObject\Timestamps;
use App\Tests\Unit\Shared\Domain\ValueObject\TimestampsMother;
use Ramsey\Uuid\Uuid;

class PostLikeMother
{
    public static function create(
        string $id,
        string $postId,
        string $userId,
        Timestamps $timestamps
    ): PostLike {
        return PostLike::like(
            $id,
            $postId,
            $userId,
            $timestamps
        );
    }

    public static function random(): PostLike
    {
        return self::create(
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            TimestampsMother::defaultNow()
        );
    }

    public static function fromCommand(PostLikerCommand $postLikerCommand): PostLike
    {
        return self::create(
            $postLikerCommand->id(),
            $postLikerCommand->postId(),
            $postLikerCommand->userId(),
            TimestampsMother::defaultNow()
        );
    }
}
