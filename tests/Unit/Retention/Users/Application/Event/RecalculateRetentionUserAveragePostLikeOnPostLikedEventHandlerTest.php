<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Event;

use App\Retention\Users\Application\Command\RecalculatorRetentionUserAveragePostLikeCommand;
use App\Retention\Users\Application\Event\RecalculateRetentionUserAveragePostLikeOnPostLikedEventHandler;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Tests\Unit\RRSS\PostLikes\Domain\PostLikedDomainEventMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class RecalculateRetentionUserAveragePostLikeOnPostLikedEventHandlerTest extends TestCase
{
    private CommandBus|MockObject $commandBus;

    public function setUp(): void
    {
        $this->commandBus = $this->createMock(CommandBus::class);
    }

    /** @test */
    public function itShouldReceivedPostLikedDomainEvent(): void
    {
        $event = PostLikedDomainEventMother::random();

        $this->commandBus
            ->expects(self::once())
            ->method('command')
            ->with(new RecalculatorRetentionUserAveragePostLikeCommand($event->userId()));

        $handler = new RecalculateRetentionUserAveragePostLikeOnPostLikedEventHandler($this->commandBus);
        $handler->on($event);
    }
}
