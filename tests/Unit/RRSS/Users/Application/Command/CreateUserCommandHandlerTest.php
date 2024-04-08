<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Application\Command;

use App\RRSS\Users\Application\Command\CreateUserCommandHandler;
use App\RRSS\Users\Domain\UserRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Tests\Unit\RRSS\Users\Domain\UserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateUserCommandHandlerTest extends TestCase
{
    private UserRepository|MockObject $userRepository;
    private EventBus|MockObject $eventBus;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->eventBus       = $this->createMock(EventBus::class);
    }

    public function testCreateUser(): void
    {
        // GIVEN

        $command      = CreateUserCommandMother::random();
        $userExpected = UserMother::fromCommand($command);

        // WHEN

        $this->userRepository
            ->expects(self::once())
            ->method('save')
            ->with($userExpected);

        $this->eventBus
            ->expects(self::once())
            ->method('publish')
            ->with(...$userExpected->pullDomainEvents());

        $handler = new CreateUserCommandHandler(
            $this->userRepository,
            $this->eventBus,
        );

        $handler($command);
    }
}
