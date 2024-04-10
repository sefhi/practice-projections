<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\CreateRetentionUserCommand;
use App\Retention\Users\Application\Command\CreateRetentionUserCommandHandler;
use App\RRSS\Users\Domain\UserRegisteredDomainEvent;
use App\Shared\Domain\Bus\Event\EventHandler;

final readonly class CreateRetentionUserOnUserRegisteredEventHandler implements EventHandler
{
    public function __construct(
        private CreateRetentionUserCommandHandler $createRetentionUserCommandHandler,
    ) {
    }

    public function __invoke(UserRegisteredDomainEvent $event): void
    {
        ($this->createRetentionUserCommandHandler)(
            new CreateRetentionUserCommand(
                $event->getId(),
                $event->getName(),
                $event->getEmail(),
            )
        );
    }
}
