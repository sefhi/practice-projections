<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\Failover;

use App\Shared\Domain\Bus\Event\DomainEvent;
use Doctrine\ORM\EntityManagerInterface;

final class DomainEventFailover
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function publishEventFailover(DomainEvent $event): void
    {
        $body  = json_encode($event);
        $class = $event::class;
        $query = <<<SQL
                    INSERT INTO shared_failover_domain_events (event_id, event_name, body, domain_event_class)
                    VALUES ('{$event->eventId()}', '{$event::eventName()}', '$body', '$class')
                SQL;

        $this->entityManager->getConnection()->prepare($query)->executeQuery();
    }

    public function pullEventFailovers(): array
    {
        $query = <<<SQL
                    SELECT * FROM shared_failover_domain_events
                SQL;

        return $this->entityManager->getConnection()->prepare($query)->executeQuery()->fetchAllAssociative();
    }

    public function consumeEventFailover(string $eventId): void
    {
        $query = <<<SQL
                    DELETE FROM shared_failover_domain_events WHERE event_id = '$eventId'
                SQL;

        $this->entityManager->getConnection()->prepare($query)->executeQuery();
    }
}
