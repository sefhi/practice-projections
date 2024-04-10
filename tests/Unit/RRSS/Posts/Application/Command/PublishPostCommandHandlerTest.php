<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Posts\Application\Command;

use App\RRSS\Posts\Application\Command\PublishPostCommandHandler;
use App\RRSS\Posts\Domain\PostRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Tests\Unit\RRSS\Posts\Domain\PostMother;
use App\Tests\Unit\Shared\Domain\ValueObject\TimestampsMother;
use PHPUnit\Framework\TestCase;

final class PublishPostCommandHandlerTest extends TestCase
{
    public function setUp(): void
    {
        $this->eventBus       = $this->createMock(EventBus::class);
        $this->postRepository = $this->createMock(PostRepository::class);
    }

    /** @test */
    public function itShouldPublishAPost(): void
    {
        $command      = PublishPostCommandMother::random();
        $postExpected = PostMother::fromCommand($command);
        $timestamp    = TimestampsMother::create($postExpected->createdAt());

        $this->postRepository
            ->expects(self::once())
            ->method('save');

        $this->eventBus
            ->expects(self::once())
            ->method('publish');

        $handler = new PublishPostCommandHandler(
            $this->postRepository,
            $this->eventBus,
            $timestamp
        );

        $handler($command);
    }
}
