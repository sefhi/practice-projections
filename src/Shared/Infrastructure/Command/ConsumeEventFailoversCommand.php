<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Command;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Infrastructure\Bus\Event\Failover\DomainEventFailover;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:consume-event-failovers',
    description: 'Consume event failovers'
)]
final class ConsumeEventFailoversCommand extends Command
{
    public function __construct(
        private readonly DomainEventFailover $failover,
        private readonly EventBus $eventBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $failovers    = $this->failover->pullEventFailovers();
        $eventDomains = [];

        foreach ($failovers as $failover) {
            $class       = $failover['domain_event_class'];
            $body        = json_decode($failover['body'], true);
            $eventId     = $failover['event_id'];
            $aggregateId = $body['id'];

            $event = $class::fromPrimitives($aggregateId, $body, $eventId);

            if ($event instanceof DomainEvent) {
                $this->failover->consumeEventFailover($event->eventId());
                $eventDomains[] = $event;
            }
        }

        $this->eventBus->publish(...$eventDomains);

        return Command::SUCCESS;
    }
}
