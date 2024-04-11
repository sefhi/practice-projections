<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\RecalculatorRetentionUserAveragePostLikeCommand;
use App\RRSS\PostLikes\Domain\PostLikedDomainEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\EventHandler;

final class RecalculateRetentionUserAveragePostLikeOnPostLikedEventHandler implements EventHandler
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function on(PostLikedDomainEvent $event): void
    {
        $this->commandBus->command(new RecalculatorRetentionUserAveragePostLikeCommand($event->userId()));
    }
}
