<?php

declare(strict_types=1);

namespace App\RRSS\PostLikes\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Timestamps;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class PostLike extends AggregateRoot
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $postId,
        private UuidInterface $userId,
        private Timestamps $dates
    ) {
    }

    public static function like(
        string $id,
        string $postId,
        string $userId,
        Timestamps $dates
    ): self {
        $postLike = new self(
            Uuid::fromString($id),
            Uuid::fromString($postId),
            Uuid::fromString($userId),
            $dates->now(),
        );

        $postLike->record(
            new PostLikedDomainEvent(
                $postLike->id->toString(),
                $postLike->postId->toString(),
                $postLike->userId->toString(),
            )
        );

        return $postLike;
    }

    public function id(): string
    {
        return $this->id->toString();
    }

    public function postId(): string
    {
        return $this->postId->toString();
    }

    public function userId(): string
    {
        return $this->userId->toString();
    }

    public function timestamps(): Timestamps
    {
        return $this->dates;
    }
}
