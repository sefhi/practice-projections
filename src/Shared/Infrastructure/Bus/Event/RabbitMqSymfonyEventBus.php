<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

final class RabbitMqSymfonyEventBus implements EventBus
{
    public function __construct(
        private MessageBusInterface $eventBus
    ) {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->eventBus->dispatch(
                $event,
                [
                    new AmqpStamp($event::eventName()),
                ]
            );
        }
    }
}
