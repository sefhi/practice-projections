<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\IncrementRetentionUserTotalPostsCommand;
use App\Retention\Users\Application\Event\IncrementRetentionUserTotalPostsOnPostPublishedEventHandler;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Tests\Unit\RRSS\Posts\Domain\PostPublishedDomainEventMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class IncrementRetentionUserTotalPostsOnPostPublishedEventHandlerTest extends TestCase
{
    private CommandBus|MockObject $commandBus;

    public function setUp(): void
    {
        $this->commandBus = $this->createMock(CommandBus::class);
    }

    /** @test */
    public function itShouldReceivedPOstPublishedDomainEvent(): void
    {
        $event = PostPublishedDomainEventMother::random();

        $this->commandBus
            ->expects(self::once())
            ->method('command')
            ->with(new IncrementRetentionUserTotalPostsCommand($event->userId()));

        $handler = new IncrementRetentionUserTotalPostsOnPostPublishedEventHandler($this->commandBus);
        $handler->on($event);
    }
}
