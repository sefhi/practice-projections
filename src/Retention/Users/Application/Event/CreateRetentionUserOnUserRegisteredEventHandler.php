<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\CreateRetentionUserCommand;
use App\Retention\Users\Application\Command\CreateRetentionUserCommandHandler;
use App\RRSS\Users\Domain\UserRegisteredDomainEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final readonly class CreateRetentionUserOnUserRegisteredEventHandler implements EventSubscriberInterface
{
    public function __construct(
        private CreateRetentionUserCommandHandler $createRetentionUserCommandHandler,
    ) {
    }

    public function on(UserRegisteredDomainEvent $event): void
    {
        ($this->createRetentionUserCommandHandler)(
            new CreateRetentionUserCommand(
                $event->getId(),
                $event->getName(),
                $event->getEmail(),
            )
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisteredDomainEvent::class => 'on',
        ];
    }
}
