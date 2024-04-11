<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\IncrementRetentionUserTotalPostsCommand;
use App\RRSS\Posts\Domain\PostPublishedDomainEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\EventHandler;

final class IncrementRetentionUserTotalPostsOnPostPublishedEventHandler implements EventHandler
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function on(PostPublishedDomainEvent $event): void
    {
        $this->commandBus->command(new IncrementRetentionUserTotalPostsCommand($event->userId()));
    }
}
