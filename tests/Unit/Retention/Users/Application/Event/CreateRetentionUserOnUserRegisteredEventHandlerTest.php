<?php

namespace App\Tests\Unit\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\CreateRetentionUserCommand;
use App\Retention\Users\Application\Command\CreateRetentionUserCommandHandler;
use App\Retention\Users\Application\Event\CreateRetentionUserOnUserRegisteredEventHandler;
use App\Tests\Unit\RRSS\Users\Domain\UserRegisteredDomainEventMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateRetentionUserOnUserRegisteredEventHandlerTest extends TestCase
{
    private CreateRetentionUserCommandHandler|MockObject $createRetentionUser;

    public function setUp(): void
    {
        $this->createRetentionUser = $this->createMock(CreateRetentionUserCommandHandler::class);
    }

    /** @test */
    public function itShouldReceiveAnEventAndCreateARetentionUser(): void
    {
        $event = UserRegisteredDomainEventMother::random();

        $this->createRetentionUser
            ->expects(self::once())
            ->method('__invoke')
            ->with(
                new CreateRetentionUserCommand(
                    $event->getId(),
                    $event->getName(),
                    $event->getEmail(),
                )
            );

        $handler = new CreateRetentionUserOnUserRegisteredEventHandler($this->createRetentionUser);
        $handler->on($event);
    }
}
