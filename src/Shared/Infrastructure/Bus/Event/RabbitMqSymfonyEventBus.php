<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Infrastructure\Bus\Event\Failover\DomainEventFailover;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

final class RabbitMqSymfonyEventBus implements EventBus
{
    public function __construct(
        private readonly MessageBusInterface $eventBus,
        private readonly DomainEventFailover $failover
    ) {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            try {
                $this->eventBus->dispatch(
                    $event,
                    [
                        new AmqpStamp($event::eventName()),
                    ]
                );
            } catch (\Exception $e) {
                $this->failover->publishEventFailover($event);
            }
        }
    }
}
