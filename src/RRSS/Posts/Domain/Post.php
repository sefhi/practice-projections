<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain;

use App\RRSS\Posts\Domain\ValueObject\PostContent;
use App\RRSS\Posts\Domain\ValueObject\PostLikes;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Timestamps;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Post extends AggregateRoot
{
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UuidInterface $userId,
        private readonly PostContent $content,
        private readonly PostLikes $likes,
        private readonly Timestamps $dates
    ) {
    }

    public static function publish(
        string $id,
        string $userId,
        string $content,
        Timestamps $dates
    ): self {
        return new self(
            Uuid::fromString($id),
            Uuid::fromString($userId),
            PostContent::fromString($content),
            PostLikes::init(),
            $dates->now()
        );
    }

    public function id(): string
    {
        return $this->id->toString();
    }

    public function userId(): string
    {
        return $this->userId->toString();
    }

    public function content(): string
    {
        return $this->content->value();
    }

    public function likes(): int
    {
        return $this->likes->value();
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->dates->getCreatedAt();
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->dates->getUpdatedAt();
    }
}
