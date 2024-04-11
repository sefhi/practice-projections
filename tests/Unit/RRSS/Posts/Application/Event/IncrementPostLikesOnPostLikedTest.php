<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Posts\Application\Event;

use App\RRSS\Posts\Application\Command\PostLikesIncrementerCommand;
use App\RRSS\Posts\Application\Event\IncrementPostLikesOnPostLiked;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Tests\Unit\RRSS\PostLikes\Domain\PostLikedDomainEventMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class IncrementPostLikesOnPostLikedTest extends TestCase
{
    private CommandBus|MockObject $commandBus;

    public function setUp(): void
    {
        $this->commandBus = $this->createMock(CommandBus::class);
    }

    /** @test  */
    public function itShouldReceivedPostLikedDomainEvent(): void
    {
        $postLiked = PostLikedDomainEventMother::random();

        $this->commandBus
            ->expects(self::once())
            ->method('command')
            ->with(new PostLikesIncrementerCommand($postLiked->postId()));

        $handler = new IncrementPostLikesOnPostLiked($this->commandBus);

        $handler->on($postLiked);
    }
}
