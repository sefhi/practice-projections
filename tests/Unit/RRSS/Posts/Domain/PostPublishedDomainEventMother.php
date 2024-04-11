<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Posts\Domain;

use App\RRSS\Posts\Domain\PostPublishedDomainEvent;
use Ramsey\Uuid\Uuid;

final class PostPublishedDomainEventMother
{
    public static function random(): PostPublishedDomainEvent
    {
        return new PostPublishedDomainEvent(
            Uuid::uuid7()->toString(),
            Uuid::uuid7()->toString(),
            'content'
        );
    }
}
