<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\PostLikes\Domain;

use App\RRSS\PostLikes\Domain\PostLikedDomainEvent;
use Ramsey\Uuid\Uuid;

final class PostLikedDomainEventMother
{
    public static function create(
        string $id,
        string $postId,
        string $userId
    ): PostLikedDomainEvent {
        return new PostLikedDomainEvent($id, $postId, $userId);
    }

    public static function random(): PostLikedDomainEvent
    {
        return self::create(
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
        );
    }
}
