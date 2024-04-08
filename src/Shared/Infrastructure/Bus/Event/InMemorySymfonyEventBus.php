<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final readonly class InMemorySymfonyEventBus implements EventBus
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event);
        }
    }
}
