<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Event;

use App\RRSS\PostLikes\Domain\PostLikedDomainEvent;
use App\RRSS\Posts\Application\Command\PostLikesIncrementerCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\EventHandler;

final class IncrementPostLikesOnPostLiked implements EventHandler
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function on(PostLikedDomainEvent $event): void
    {
        $this->commandBus->command(new PostLikesIncrementerCommand($event->postId()));
    }
}
