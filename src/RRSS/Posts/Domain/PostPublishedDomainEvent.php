<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class PostPublishedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $id,
        private readonly string $userId,
        private readonly string $content,
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
            $body['userId'],
            $body['content'],
            $eventId,
            $occurredOn
        );
    }

    public static function eventName(): string
    {
        return 'practice-projections.rrss.post.published';
    }

    public function toPrimitives(): array
    {
        return [
            'id'      => $this->id,
            'userId'  => $this->userId,
            'content' => $this->content,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
