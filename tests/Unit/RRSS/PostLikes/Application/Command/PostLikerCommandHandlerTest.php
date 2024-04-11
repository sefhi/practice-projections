<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\PostLikes\Application\Command;

use App\RRSS\PostLikes\Application\Command\PostLikerCommandHandler;
use App\RRSS\PostLikes\Domain\PostLikeRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Tests\Unit\Shared\Domain\ValueObject\TimestampsMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class PostLikerCommandHandlerTest extends TestCase
{
    private PostLikeRepository|MockObject $postLikeRepository;
    private EventBus|MockObject $eventBus;

    public function setUp(): void
    {
        $this->postLikeRepository = $this->createMock(PostLikeRepository::class);
        $this->eventBus           = $this->createMock(EventBus::class);
    }

    /** @test */
    public function itShouldLikeAPost(): void
    {
        $postLikerCommand = PostLikerCommandMother::random();
        $timestamp        = TimestampsMother::defaultNow();

        $this->postLikeRepository
            ->expects($this->once())
            ->method('save');

        $this->eventBus
            ->expects($this->once())
            ->method('publish');

        $handler = new PostLikerCommandHandler($this->postLikeRepository, $this->eventBus, $timestamp);
        $handler($postLikerCommand);
    }
}
