<?php

declare(strict_types=1);

namespace App\RRSS\PostLikes\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class PostLikedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $id,
        private readonly string $postId,
        private readonly string $userId,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        ?string $eventId = null,
        ?string $occurredOn = null
    ): self {
        return new self(
            $aggregateId,
            $body['postId'],
            $body['userId'],
            $eventId,
            $occurredOn
        );
    }

    public static function eventName(): string
    {
        return 'practice-projections.rrss.post.liked';
    }

    public function toPrimitives(): array
    {
        return [
            'id'     => $this->id,
            'postId' => $this->postId,
            'userId' => $this->userId,
        ];
    }
}
