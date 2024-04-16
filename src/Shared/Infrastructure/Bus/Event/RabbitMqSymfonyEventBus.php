<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Infrastructure\Bus\Event\Failover\DomainEventFailover;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

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
                    (new Envelope($event))->with(new DispatchAfterCurrentBusStamp(), new AmqpStamp($event::eventName())),
                );
            } catch (\Exception $e) {
                $this->failover->publishEventFailover($event);
            }
        }
    }
}
